Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');
Vue.config.devtools = true;

new Vue({

    el: '#enterprise_area',

    data: {
        categories: [],
        enterpriseThanks: [],
        pagination: {
            total: 0, 
            per_page: 2,
            from: 1, 
            to: 0,
            current_page: 1
        },
        offset: 4,        
        formErrors: {},
        formErrorsUpdate: {},
        formErrorsThanks: {},
        updatePassword: {'currentPassword':'','password':'','id':''},
        fillEnterpriseThanks: {'client':'','thanksDateTime':'','content':'','replica':'','rejoinder':'','id':''},
        logo: ''
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    ready : function(){
        this.getEnterpriseThanks(this.pagination.current_page);
    },

    methods : {

        getEnterpriseThanks: function(page){
            this.$http.get('/empresas/agradecimentos?page='+page).then((response) => {
                this.$set('enterpriseThanks', response.data.data.data);
                this.$set('pagination', response.data.pagination);
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getEnterpriseThanks(page);
        },

        changePassword: function(id){
            var input = this.updatePassword;
            this.$http.post('/empresa/perfil/alterar-senha/'+id,input).then((response) => {
                if(response.data.status == true) {
                    this.updatePassword = {'password':'','id':''};
                    $("#changePasswordModal").modal('hide');
                    toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
                } else {
                    toastr.error('A Senha atual não confere!', '', {timeOut: 5000});
                }                
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
        },

        replyThanks: function(enterpriseThanks){
            this.fillEnterpriseThanks.client = enterpriseThanks.user.name + ' ' + enterpriseThanks.user.surName;
            this.fillEnterpriseThanks.content = enterpriseThanks.content;
            this.fillEnterpriseThanks.replica = enterpriseThanks.replica;
            this.fillEnterpriseThanks.rejoinder = enterpriseThanks.rejoinder;
            this.fillEnterpriseThanks.id = enterpriseThanks.id;
            $("#replyThanks").modal('show');
        }

    }

});