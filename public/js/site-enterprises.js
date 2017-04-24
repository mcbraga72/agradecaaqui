Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#createEnterprise',

    data: {
        enterprises: [],
        categories: [],
        formThanksErrors:{},
        formErrors:{},
        newEnterprise : {'category_id': '','name': '','contact': '','email': '','site': '','telephone': '','address': ''},
        enterprise_id: '',
    },

    ready : function(){
        this.getCategories();
        this.getEnterprises();
    },

    methods : {

        getCategories: function(page){
            this.$http.get('/app/categorias').then((response) => {
                this.$set('categories', response.data);
            });
        },

        getEnterprises: function(){
            this.$http.get('/app/empresas').then((response) => {
                this.$set('enterprises', response.data);
            });
        },
        
        createEnterprise: function(){
            var input = this.newEnterprise;
            this.$http.post('/cadastro/empresa',input).then((response) => {
                this.newEnterprise = {'category_id': '','name':'','contact': '','email':'','site': '','telephone': '','address': ''};
                $("#enterprise").modal('hide');
                this.getEnterprises();
                toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },
    
    }

});