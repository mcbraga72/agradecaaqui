Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#enterprises',

    data: {
        categories: [],
        enterprises: [],
        pagination: {
            total: 0, 
            per_page: 2,
            from: 1, 
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newEnterprise : {'category_id': '','name': '','contact': '','email': '','site': '','telephone': '','address': '','logo': '','password': '','passwordConfirm': ''},
        fillEnterprise : {'category_id': '','name': '','contact': '','email': '','site': '','telephone': '','address': '','id': ''},
        sortProperty: 'name',
        sortDirection: 1,
        filterTerm: ''
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
  	   	this.getEnterprises(this.pagination.current_page);
    },

    methods : {

        getEnterprises: function(page){
            this.$http.get('/admin/empresas?page='+page).then(function(response) {
                this.$set('enterprises', response.data.data.data);
                this.$set('pagination', response.data.pagination);
                this.$set('categories', response.data.categories);
            });
        },

        createEnterprise: function(){
            if (this.newEnterprise.password == this.newEnterprise.passwordConfirm) {
		        var input = this.newEnterprise;
		        this.$http.post('/admin/empresas',input).then(function(response) {
		            this.changePage(this.pagination.current_page);
			        this.newEnterprise = {'category_id': '','name':'','contact': '','email':'','site': '','telephone': '','address': '','logo': '','password': '','passwordConfirm': ''};
			        $("#createEnterprise").modal('hide');
			        toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 3000});
                    setTimeout(function(){window.location.href = '/admin/empresas/listar'} , 3000);
		        }, function(response) {
			        this.formErrors = response.data;
	            });
            } else {
                toastr.error('Os campos Senha e Confirmar Senha devem possuir valores iguais!', '', {timeOut: 5000});
            }   
	    },

        deleteEnterprise: function(enterprise){
            this.$http.delete('/admin/empresas/'+enterprise.id).then(function(response) {
                this.changePage(this.pagination.current_page);
                toastr.success('Empresa removida com sucesso!', '', {timeOut: 5000});
            });
        },

        editEnterprise: function(enterprise){
            this.fillEnterprise.id = enterprise.id;
            this.fillEnterprise.category_id = enterprise.category_id;
            this.fillEnterprise.name = enterprise.name;
            this.fillEnterprise.contact = enterprise.contact;
            this.fillEnterprise.email = enterprise.email;
            this.fillEnterprise.site = enterprise.site;
            this.fillEnterprise.telephone = enterprise.telephone;
            this.fillEnterprise.address = enterprise.address;
            $("#editEnterprise").modal('show');
        },

        updateEnterprise: function(id){
            var input = this.fillEnterprise;
            this.$http.put('/admin/empresas/'+id,input).then(function(response) {
                this.changePage(this.pagination.current_page);
                this.fillEnterprise = {'category_id': '','name':'','contact': '','email':'','site': '','telephone': '','address': '','id':''};
                $("#editEnterprise").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, function(response) {
                this.formErrorsUpdate = response.data;
            });
        },

        approveEnterpriseRegister: function(enterprise){
            this.$http.put('/admin/empresa/aprovar/'+enterprise.id).then(function(response) {
                this.changePage(this.pagination.current_page);
                toastr.success('Cadastro ativado com sucesso!', '', {timeOut: 5000});
            });
        },

        resetPassword: function(enterprise){
            this.$http.post('/empresa/enviar-senha'+enterprise.email).then(function(response) {
                toastr.success('E-mail de alteração de senha enviado para a empresa!', '', {timeOut: 5000});
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getEnterprises(page);
        },

        sort (ev, property) {
            ev.preventDefault();
            this.setProperty = property;
            if(this.sortDirection == 1) {
                this.sortDirection = -1;
            } else {
                this.sortDirection = 1;
            }
        }

    }

});