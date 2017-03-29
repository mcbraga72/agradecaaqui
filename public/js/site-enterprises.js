Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#createEnterprise',

    data: {
        categories: [],
        formErrors:{},
        newEnterprise : {'category_id': '','name': '','contact': '','email': '','telephone': '','address': ''}        
    },

    ready : function(){
        this.getCategories();
    },

    methods : {

        getCategories: function(page){
            this.$http.get('/app/categorias').then((response) => {
                this.$set('categories', response.data);
            });
        },
        
        createEnterprise: function(){
            var input = this.newEnterprise;
            this.$http.post('/cadastro/empresa',input).then((response) => {
                this.newEnterprise = {'category_id': '','name':'','contact': '','email':'','telephone': '','address': ''};
                $("#createEnterprise").modal('hide');
                toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },
    
    }

});