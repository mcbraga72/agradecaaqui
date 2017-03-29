Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#user_area',

    data: {
        formErrorsUpdate:{},
        updatePassword : {'currentPassword':'','password':'','id':''}
    },

    methods : {

        changePassword: function(id){
            var input = this.updatePassword;
            this.$http.post('/empresa/perfil/alterar-senha/'+id,input).then((response) => {
                this.updatePassword = {'password':'','id':''};
                $("#changePasswordModal").modal('hide');
                toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        }

    }

});