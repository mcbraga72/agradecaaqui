Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')
    }
});

Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
Vue.config.devtools = true

new Vue({

    el: '#userThanks',

    data: {
        userThanks: [],
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
        newUserThank : {'user_id':'','receiptName':'','receiptEmail':'','content':''},
        fillUserThank : {'user_id':'','receiptName':'','receiptEmail':'','content':'','id':''},
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
  	   	this.getUserThanks(this.pagination.current_page);
    },

    methods : {

        getUserThanks: function(page){
            this.$http.get('/admin/agradecimentos-usuarios?page='+page).then(function(response) {
                this.$set('userThanks', response.data.data.data);
                this.$set('pagination', response.data.pagination);                
            });
        },

        createUserThank: function(){
		        var input = this.newUserThank;
		        this.$http.post('/admin/agradecimentos-usuarios',input).then(function(response) {
		            this.changePage(this.pagination.current_page);
			          this.newUserThank = {'user_id':'','receiptName':'','receiptEmail':'','content':''};
			          $("#createUserThank").modal('hide');
			          toastr.success('Agradecimento cadastrado com sucesso!', '', {timeOut: 3000});                      
                      setTimeout(function(){window.location.href = '/admin/agradecimentos-usuarios/listar'} , 3000);
		        }, function(response) {
			          this.formErrors = response.data;
	          });
	      },

        deleteUserThank: function(userThank){
            this.$http.delete('/admin/agradecimentos-usuarios/'+userThank.id).then(function(response) {
                this.changePage(this.pagination.current_page);
                toastr.success('Agradecimento removido com sucesso!', '', {timeOut: 5000});
            });
        },

        editUserThank: function(userThank){
            this.fillUserThank.id = userThank.id;
            this.fillUserThank.user_id = userThank.user_id;            
            this.fillUserThank.receiptName = userThank.receiptName;
            this.fillUserThank.receiptEmail = userThank.receiptEmail;
            this.fillUserThank.content = userThank.content;
            $("#editUserThank").modal('show');
        },

        updateUserThank: function(id){
            var input = this.fillUserThank;
            this.$http.put('/admin/agradecimentos-usuarios/'+id,input).then(function(response) {
                this.changePage(this.pagination.current_page);
                this.fillUserThank = {'user_id':'','receiptName':'','receiptEmail':'','content':'','id':''};
                $("#editUserThank").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, function(response) {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getUserThanks(page);
        }

    }

});