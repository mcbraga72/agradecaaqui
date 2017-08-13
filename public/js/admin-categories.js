Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#categories',

    data: {
        categories: [],
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
        newCategory : {'name':''},
        fillCategory : {'name':'','id':''},
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
  	   	this.getCategories(this.pagination.current_page);
    },

    methods : {

        getCategories: function(page){
            this.$http.get('/admin/categorias?page='+page).then(function(response) {
                this.$set('categories', response.data.data.data);
                this.$set('pagination', response.data.pagination);
            });
        },

        createCategory: function(){
		        var input = this.newCategory;
		        this.$http.post('/admin/categorias',input).then(function(response) {
                    if(response.data.status == false) {
                        toastr.error('Esta categoria já está cadastrada no sistema!', '', {timeOut: 5000});
                    } else {
                        this.changePage(this.pagination.current_page);
                        this.newCategory = {'name':''};
                        $("#createCategory").modal('hide');
                        toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 3000});
                        setTimeout(function(){window.location.href = '/admin/categorias/listar'} , 3000);                        
                    }		            
		        }, function(response) {
			          this.formErrors = response.data;
	          });
	      },

        deleteCategory: function(category){
            let self = this;
            swal({
                    title: "Tem certeza que deseja remover este registro?",
                    text: "Não será mais possível recuperar os dados desse cadastro!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#D9534F",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function() {
                    self.$http.delete('/admin/categorias/'+category.id).then(function(response) {
                        self.changePage(self.pagination.current_page);
                        toastr.success('Categoria removida com sucesso!', '', {timeOut: 5000});
                    });
                }
            );            
        },

        editCategory: function(category){
            this.fillCategory.name = category.name;
            this.fillCategory.id = category.id;
            $("#editCategory").modal('show');
        },

        updateCategory: function(id){
            var input = this.fillCategory;
            this.$http.put('/admin/categorias/'+id,input).then(function(response) {
                this.changePage(this.pagination.current_page);
                this.fillCategory = {'name':'','id':''};
                $("#editCategory").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, function(response) {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getCategories(page);
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