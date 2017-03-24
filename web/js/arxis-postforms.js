$("form").submit(function(e){
            e.preventDefault();
            var dataForm;
            dataForm =new FormData(this);
            loadURLPost($(this).attr("action"),container,dataForm);
       });
