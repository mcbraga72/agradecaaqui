Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');
Vue.config.devtools = true;

new Vue({

    el: '#enterprise_area',

    data: {
        logo: '',
        formErrors: {},
        formErrorsUpdate: {},
        updatePassword: {'currentPassword':'','password':'','id':''}
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
        },

        updateLogo: function(id){
            var form = document.querySelector('#logo');
            var file = form.files[0];
            var data = new FormData();
            var image = data.append("logo", file)
            console.log(image);
            this.$http.post('/empresa/alterar-logo/'+id,data).then((response) => {            
                this.logo = '';
                $("#completeRegister").modal('hide');
                toastr.success('Logotipo atualizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formPhoto = response.data;
            });
        }

    }

});