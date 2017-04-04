Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#administrators',

    data: {
        admins: [],
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
        newAdmin : {'name':'','email':''},
        fillAdmin : {'name':'','email':'','id':''},
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
  	   	this.getAdmins(this.pagination.current_page);
    },

    methods : {

        getAdmins: function(page){
            this.$http.get('/admin/administradores?page='+page).then((response) => {
                this.$set('admins', response.data.data.data);
                this.$set('pagination', response.data.pagination);
            });
        },

        createAdmin: function(){
		        var input = this.newAdmin;
		        this.$http.post('/admin/administradores',input).then((response) => {
		            this.changePage(this.pagination.current_page);
			          this.newAdmin = {'name':'','email':''};
			          $("#createAdmin").modal('hide');
			          toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 5000});
		        }, (response) => {
			          this.formErrors = response.data;
	          });
	      },

        deleteAdmin: function(admin){
            this.$http.delete('/admin/administradores/'+admin.id).then((response) => {
                this.changePage(this.pagination.current_page);
                toastr.success('Administrador removido com sucesso!', '', {timeOut: 5000});
            });
        },

        editAdmin: function(admin){
            this.fillAdmin.name = admin.name;
            this.fillAdmin.id = admin.id;
            this.fillAdmin.email = admin.email;
            $("#editAdmin").modal('show');
        },

        updateAdmin: function(id){
            var input = this.fillAdmin;
            this.$http.put('/admin/administradores/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.fillAdmin = {'name':'','email':'','id':''};
                $("#editAdmin").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getAdmins(page);
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