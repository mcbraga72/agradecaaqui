Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#chnageUserPassword',

    data: {
        formErrors:{},
        updatePassword : {'currentPassword':'','password':'','id':''}
    },

    methods : {

        changePassword: function(id){
            var input = this.updatePassword;
            this.$http.put('/app/alterar-senha/'+id,input).then(function(response) {
                this.updatePassword = {'password':'','id':''};
                $("#changePasswordModal").modal('hide');
                toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
            }, function(response) {
                this.formErrors = response.data;
            });
        }
    
    }

});