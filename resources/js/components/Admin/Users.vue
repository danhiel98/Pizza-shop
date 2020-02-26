<template>
    <div>
        <div class="container-fluid">
            <div class="px-3 pt-md-3 pb-md-4 mx-auto text-center">
                <h3>{{ $t('messages.users_management') }}</h3>
                <small>
                    <a href="#" @click.prevent="newUserModal=true" class="btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                    </a>
                </small>
            </div>
            <div class="card-deck">
                <div class="col-md-8 mx-auto">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="my-0 font-weight-normal">
                                {{ $t('messages.users') }}
                            </h5>
                        </div>
                        <div class="card-body-3">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{ $t('messages.name') }}</th>
                                        <th class="text-center">{{ $t('messages.email') }}</th>
                                        <th class="text-center">{{ $t('messages.is_active') }}</th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, i) in users" :key="user.id">
                                        <th class="text-center" v-text="++i"></th>
                                        <td v-text="user.name"></td>
                                        <td v-text="user.email"></td>
                                        <td class="text-center">
                                            <i v-if="user.is_active" class="text-success fa fa-check"></i>
                                            <i v-else class="text-danger fa fa-times"></i>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="#" @click.prevent="resetPassword(user.id)" data-toggle="tooltip" :title="$t('messages.reset_password')" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-undo"></i>
                                                </a>
                                                <button v-if="user.is_active" :disabled="user.id == 1" @click.prevent="alternUserState(user, 'disable')" data-toggle="tooltip" :title="$t('messages.disable')" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-toggle-on"></i>
                                                </button>
                                                <button v-else @click.prevent="alternUserState(user, 'enable')" data-toggle="tooltip" :title="$t('messages.enable')" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fa fa-toggle-off"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <stack-modal
            :show="newUserModal"
            :title="`${translate('new_user')}`"
            @close="closeNewUserModal"
        >
            <div class="container">
                <form ref="frmNewUser" @submit.prevent="saveUser">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{ $t('messages.name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" :placeholder="$t('messages.name')" v-model="name" required minlength="5">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">{{ $t('messages.email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" :placeholder="$t('messages.email')" v-model="email" required minlength="5">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success">{{ $t('messages.save') }}</button>
                    </div>
                </form>
            </div>
            <div slot="modal-footer" class="modal-footer">
            </div>
        </stack-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [], // Lista de usuarios
                loadingUsers: false, // Cargando usuarios
                newUserModal: false,
                name: '',
                email: ''
            }
        },
        methods: {
            translate(key){ // Equivalente a $t en el template
                return Vue.i18n.translate(`messages.${key}`);
            },
            getUsers() { // Obtiene la lista de usuarios (que administran el sistema)
                let url = `administrators`;

                this.loadingUsers = true;
                axios.get(url)
                .then(response => {
                    this.users = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    this.loadingUsers = false;
                })
            },
            closeNewUserModal() { // Cerrar modal para nuevo usuario
                this.name = '';
                this.email = '';
                this.newUserModal = false;
            },
            saveUser(){ // Guardar usuario
                let me = this;
                let url = `administrators`;

                try {
                    axios.post(url, {
                        name: me.name,
                        email: me.email
                    })
                    .then(response => {
                        me.closeNewUserModal();
                        me.getUsers();
                        Vue.$toast.success(me.translate('created_user_message'), { position: 'top-right' });
                    })
                    .catch(error => {
                        Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    });
                } catch (error) {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                }
            },
            resetPassword(userId) { // Restablece la contraseña del usuario (secret)
                let url = `administrators/${userId}/reset`

                axios.put(url)
                .then(response => {
                    Vue.$toast.success(this.translate('password_reset_message'), { position: 'top-right' });
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            },
            alternUserState(user, state) { // Cambia entre activo e inactivo de usuario
                let url = `administrators/${user.id}/${state}`

                let message = state == 'enable' ? this.translate('user_enabled_message') : this.translate('user_disabled_message');
                axios.put(url)
                .then(response => {
                    Vue.$toast.success(message, { position: 'top-right' });
                    this.getUsers();
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            }
        },
        mounted(){
            this.getUsers();
        }
    }
</script>
<style>
    .card-body-3 {
        max-height: 350px;
        overflow-y: auto;
    }
</style>
