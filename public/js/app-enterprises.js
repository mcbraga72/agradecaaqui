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
        fillEnterpriseThanks: {'client':'','thanksDateTime':'','content':'','replica':'','rejoinder':'','hash':''},
        logo: null
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
            this.$http.get('/empresas/agradecimentos?page='+page).then(function(response) {
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
            this.$http.post('/empresa/perfil/alterar-senha/'+id,input).then(function(response) {
                if(response.data.status == true) {
                    this.updatePassword = {'password':'','id':''};
                    $("#changePasswordModal").modal('hide');
                    toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
                } else {
                    toastr.error('A Senha atual não confere!', '', {timeOut: 5000});
                }                
            }, function(response) {
                this.formErrorsUpdate = response.data;
            });
        },

        updateLogo: function(){
            var form = document.querySelector('#logo');
            var file = form.files[0];
            var data = new FormData();
            var image = data.append("logo", file)
            if (this.logo == null) {
                toastr.error('Por favor, selecione uma imagem.', '', {timeOut: 5000});
            } else {    
                this.$http.post('/empresa/alterar-logo',data).then(function(response) {            
                    this.logo = null;
                    toastr.success('Logotipo atualizado com sucesso!', '', {timeOut: 5000});
                    setTimeout(function(){window.location.href = '/empresa/painel'} , 5000);
                }, function(response) {
                    this.formPhoto = response.data;
                });
            }
        },

        replyThanks: function(enterpriseThanks){
            this.fillEnterpriseThanks.hash = enterpriseThanks.hash;
            this.fillEnterpriseThanks.client = enterpriseThanks.user.name + ' ' + enterpriseThanks.user.surName;
            this.fillEnterpriseThanks.content = enterpriseThanks.content.replace(/<.+?>/g, '');
            
            if (enterpriseThanks.replica == null) {
                this.fillEnterpriseThanks.replica = enterpriseThanks.replica;
            } else {
                this.fillEnterpriseThanks.replica = enterpriseThanks.replica.replace(/<.+?>/g, '');
            }
            
            if (enterpriseThanks.rejoinder == null) {
                this.fillEnterpriseThanks.rejoinder = enterpriseThanks.rejoinder;
            } else {
                this.fillEnterpriseThanks.rejoinder = enterpriseThanks.rejoinder.replace(/<.+?>/g, '');
            }            
            
            $("#replyThanks").modal('show');            
        },

        updateThanks: function(enterpriseThanks){
            this.$http.post('/empresa/agradecimento',this.fillEnterpriseThanks).then(function(response) {
                $("#replyThanks").modal('hide');
                this.changePage(this.pagination.current_page);
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});                
            }, function(response) {
                this.formErrorsThanks = response.data;
            });
        }

    }

});