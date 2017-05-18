Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#users',

    data: {
        users: [],
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
        newUser : {'name':'','surName':'','gender':'','dateOfBirth':'','telephone':'','city':'','state':'','email':'','password':'','passwordConfirm':''},
        fillUser : {'name':'','surName':'','gender':'','dateOfBirth':'','telephone':'','city':'','state':'','email':'','id':''},
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
  	   	this.getUsers(this.pagination.current_page);
    },

    methods : {

        getUsers: function(page){
            this.$http.get('/admin/usuarios?page='+page).then((response) => {
                this.$set('users', response.data.data.data);
                this.$set('pagination', response.data.pagination);
            });
        },

        createUser: function(){
            if (this.newUser.password == this.newUser.passwordConfirm) {
		        var input = this.newUser;
		        this.$http.post('/admin/usuarios',input).then((response) => {
		            this.changePage(this.pagination.current_page);
			        this.newUser = {'name':'','surName':'','gender':'','dateOfBirth':'','telephone':'','city':'','state':'','email':'','password':''};
			        $("#createUser").modal('hide');
			        toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 5000});
		        }, (response) => {
			        this.formErrors = response.data;
	            });
            } else {
                toastr.error('Os campos Senha e Confirmar Senha devem possuir valores iguais!', '', {timeOut: 5000});
            }
	    },

        deleteUser: function(user){
            this.$http.delete('/admin/usuarios/'+user.id).then((response) => {
                this.changePage(this.pagination.current_page);
                toastr.success('Usuário removido com sucesso!', '', {timeOut: 5000});
            });
        },

        editUser: function(user){            
            this.fillUser.id = user.id;
            this.fillUser.name = user.name;
            this.fillUser.surName = user.surName;
            this.fillUser.gender = user.gender;
            this.fillUser.dateOfBirth = user.dateOfBirth;
            this.fillUser.telephone = user.telephone;
            this.fillUser.city = user.city;
            this.fillUser.state = user.state;
            this.fillUser.email = user.email;
            $("#editUser").modal('show');
        },

        updateUser: function(id){
            var input = this.fillUser;
            this.$http.put('/admin/usuarios/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.fillUser = {'name':'','surName':'','gender':'','dateOfBirth':'','telephone':'','city':'','state':'','email':'','id':''};
                $("#editUser").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getUsers(page);
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