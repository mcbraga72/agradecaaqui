Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');
Vue.config.devtools = true;

new Vue({

    el: '#enterprise_area',

    data: {
        data: [],
        formErrors: {},
        fillEnterpriseThanks: {'client':'','thanksDateTime':'','content':'','replica':'','rejoinder':'','id':''}    
    },

    methods : {

        showGraph: function(id){
            this.$http.post('/empresa/api/relatorios/personalizado',input).then((response) => {
                this.fillEnterpriseThanks.client = enterpriseThanks.user.name + ' ' + enterpriseThanks.user.surName;
                this.fillEnterpriseThanks.content = enterpriseThanks.content;
                this.fillEnterpriseThanks.replica = enterpriseThanks.replica;
                this.fillEnterpriseThanks.rejoinder = enterpriseThanks.rejoinder;
                this.fillEnterpriseThanks.id = enterpriseThanks.id;
                $("#customReportModal").modal('show');
            }, (response) => {
                this.formErrors = response.data;
                toastr.success('Não foi possível gerar o relatório!', '', {timeOut: 5000});
            });
        }
        
    }

});