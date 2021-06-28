class Recipes{

  static init(){
    $("#add-recipes").validate({
     submitHandler: function(form, event) {
       event.preventDefault();
       var data = AUtils.form2json($(form));

       if(data.id){
         Recipes.update(data);
       }else{
         Recipes.add(data);
       }
     }
    });
    AUtils.role_based_elements();
    Recipes.get_all();
  //  EmailTemplate.chart();
  }
/*
  static chart(){
    RestClient.get("api/user/recipes_chart", function(chart_data){
      new Morris.Line({
        element: 'recipes-chart-container',
        data: chart_data,
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value']
      });
    });
  }
*/
  static get_all(){
    $("#recipes-table").DataTable({
      processing : true,            // pop-up
      serverSide : true,           //data is loaded from server
      bDestroy: true,             // refresh table once data is added
      pagingType : "simple",     // organization of buttons in lower corner
      preDrawCallback: function(settings){
        if(settings.aoData.length < settings._iDisplayLength){
          // disable pagination
          settings._iRecordsTotal = 0;
          settings._iRecordsDisplay = 0;
        }else{
          // emable pagination
          settings._iRecordsTotal = 100000;
          settings._iRecordsDisplay = 100000;
        }
      },

      responsive: true,

      language: {
        "zeroRecords":"Nothing found - sorry",
        "info": "Showing page _PAGE_",
        "infoEmpty": "No records available",
        "infoFiltered": ""
      },

      ajax : {                                                   // fetch data from server
        url: "api/user/recipes?order="+encodeURIComponent("+id"),
        type: "GET",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
        },
        data: function(d){                          // map data table parameters into our API parameters
          d.offset=d.start;
          d.limit=d.length;
          d.search = d.search.value;

          //order in our format
          d.order = encodeURIComponent((d.order[0].dir == 'asc' ? "-" : "+")+d.columns[d.order[0].column].data);

          delete d.start;
          delete d.lenght;
          delete d.columns;
          delete d.draw;

          console.log(d);
        }
      },
      columnns: [                                  //columns descriptor: used to read objects from the data source based on column names
      {"data":"id",
        "render": function(data, type, row, meta){
          return '<div style="min-width: 60px;"><span class="badge">'+data+'</span><a class="pull-right" style="font-size: 15px; cursor: pointer;" onClick="Recipes.pre_edit('+data+')"><i clas="fa fa-edit"></i></a> </div>';
        }
      },
      {"data":"recipe_name"},
      {"data":"recipe_difficulty_level"},
      {"data":"description"},
    //  {"data":"ingredients_list"},
  //    {"data":"measurements"},
      {"data":"tips"},
      {"data":"created_at"}
      ]
    });
  }

  static add(email_template){
      RestClient.post("api/user/recipes", recipe, function(data){
      toastr.success("Recipe has been created");
      Recipes.get_all();
      $("#add-recipes").trigger("reset");
      $("#add-recipe-modal").modal("hide");
    });
  }

  static update(email_template){
    RestClient.put("api/user/recipes/"+recipe.id, recipe, function(data){
    toastr.success("Recipe has been updated");
    Recipes.get_all();
    $("#add-recipes").trigger("reset");
    $("#add-recipe *[name='id']").val("");
    $("#add-recipe-modal").modal("hide");
  });
  }

  static pre_edit(id){
    RestClient.get("api/user/recipes/"+id, function(data){
     AUtils.json2form("#add-recipe", data);
     $("#add-recipe-modal").modal("show");
   });
  }

}
