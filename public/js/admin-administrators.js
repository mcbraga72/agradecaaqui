Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({

  el: '#manage-vue',

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
    fillAdmin : {'name':'','email':'','id':''}
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
  		this.getVueAdmins(this.pagination.current_page);
  },

  methods : {

        getVueAdmins: function(page){
          this.$http.get('/vueadmins?page='+page).then((response) => {
            this.$set('admins', response.data.data.data);
            this.$set('pagination', response.data.pagination);
          });
        },

        createAdmin: function(){
		  var input = this.newAdmin;
		  this.$http.post('/vueadmins',input).then((response) => {
		    this.changePage(this.pagination.current_page);
			this.newAdmin = {'name':'','email':''};
			$("#create-admin").modal('hide');
			toastr.success('Cadastro realizado com sucesso!', 'Success Alert', {timeOut: 5000});
		  }, (response) => {
			this.formErrors = response.data;
	    });
	},

      deleteAdmin: function(admin){
        this.$http.delete('/vueadmins/'+admin.id).then((response) => {
            this.changePage(this.pagination.current_page);
            toastr.success('Administrador removido com sucesso!.', 'Success Alert', {timeOut: 5000});
        });
      },

      editAdmin: function(admin){
          this.fillAdmin.name = admin.name;
          this.fillAdmin.id = admin.id;
          this.fillAdmin.email = admin.email;
          $("#edit-admin").modal('show');
      },

      updateAdmin: function(id){
        var input = this.fillAdmin;
        this.$http.put('/vueadmins/'+id,input).then((response) => {
            this.changePage(this.pagination.current_page);
            this.fillAdmin = {'name':'','email':'','id':''};
            $("#edit-admin").modal('hide');
            toastr.success('Dados atualizados com sucesso!', 'Success Alert', {timeOut: 5000});
          }, (response) => {
              this.formErrorsUpdate = response.data;
          });
      },

      changePage: function (page) {
          this.pagination.current_page = page;
          this.getVueAdmins(page);
      }

  }

});