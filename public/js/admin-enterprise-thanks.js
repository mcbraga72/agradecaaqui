Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')
    }
});

Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#enterpriseThanks',

    data: {
        enterprises: [],
        enterpriseThanks: [],
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
        newEnterpriseThank : {'enterprise_id':'','content':''},
        fillEnterpriseThank : {'enterprise_id':'','content':'','id':''}
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
            this.$http.get('/admin/agradecimentos-empresas?page='+page).then(function(response) {
                this.$set('enterpriseThanks', response.data.data.data);
                this.$set('pagination', response.data.pagination);
                this.$set('enterprises', response.data.enterprises);
            });
        },

        createEnterpriseThank: function(){
		        var input = this.newEnterpriseThank;
		        this.$http.post('/admin/agradecimentos-empresas',input).then(function(response) {
		            this.changePage(this.pagination.current_page);
			          this.newEnterpriseThank = {'enterprise_id':'','content':''};
			          $("#createEnterpriseThank").modal('hide');
			          toastr.success('Agradecimento cadastrado com sucesso!', '', {timeOut: 5000});
                      setTimeout(function(){window.location.href = '/admin/agradecimentos-empresas/listar'} , 3000);
		        }, function(response) {
			          this.formErrors = response.data;
	          });
	      },

        deleteEnterpriseThank: function(enterpriseThank){
            this.$http.delete('/admin/agradecimentos-empresas/'+enterpriseThank.id).then(function(response) {
                this.changePage(this.pagination.current_page);
                toastr.success('Agradecimento removido com sucesso!', '', {timeOut: 5000});
            });
        },

        editEnterpriseThank: function(enterpriseThank){
            this.fillEnterpriseThank.enterprise_id = enterpriseThank.enterprise_id;
            this.fillEnterpriseThank.id = enterpriseThank.id;
            this.fillEnterpriseThank.content = enterpriseThank.content;
            $("#editEnterpriseThank").modal('show');
        },

        updateEnterpriseThank: function(id){
            var input = this.fillEnterpriseThank;
            this.$http.put('/admin/agradecimentos-empresas/'+id,input).then(function(response) {
                this.changePage(this.pagination.current_page);
                this.fillEnterpriseThank = {'enterprise_id':'','content':'','id':''};
                $("#editEnterpriseThank").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, function(response) {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getEnterpriseThanks(page);
        }

    }

});