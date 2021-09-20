class Items{

  static init(){
    $("#add-items").validate({
     submitHandler: function(form, event) {
       event.preventDefault();
       var data = AUtils.form2json($(form));

       if(data.id){
         Items.update(data);
       }else{
         Items.add(data);
       }
     }
    });
    AUtils.role_based_elements();
    Items.get_all();
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
    $("#items-table").DataTable({
      processing : true,            // pop-up
      serverSide : true,           //data is loaded from server
      bDestroy: true,             // refresh table once data is added
      pagingType : "simple",     // organization of buttons in lower corner
      responsive: true,
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

      language: {
        "zeroRecords":"Nothing found - sorry",
        "info": "Showing page _PAGE_",
        "infoEmpty": "No records available",
        "infoFiltered": ""
      },

      ajax : {                                                   // fetch data from server
        url: "api/item",       //?order="+encodeURIComponent("+id")
        type: "GET",
/*        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
        }, */
    /*    dataSrc: function(resp){
          return resp;
        }, */
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
      columns: [                                  //columns descriptor: used to read objects from the data source based on column names
      {"data":"id",
        "render": function(data, type, row, meta){
          return '<div style="min-width: 60px;"><span class="badge">'+data+'</span><a class="pull-right" style="font-size: 15px; cursor: pointer;" onClick="Items.pre_edit('+data+')"><i clas="fa fa-edit"></i></a> </div>';
        }
      },
      {"data":"title"},
      {"data":"description"},
      {"data":"preparation_time"},
      {"data":"difficulty_lvl"},
      {"data":"image_src",
      "render": function ( data, type, row, meta ) {
        return '<img src="'+data+'" alt="Item image" height="500" width="500"/>';
        }
      },
        {"data":"category_id"},
        {"data":"recipe_id"}
      ]
    });
  }

  static add(item){
      RestClient.post("api/item", recipe, function(data){
      toastr.success("Item has been created");
      Items.get_all();
      $("#add-items").trigger("reset");
      $("#add-items-modal").modal("hide");
    });
  }

/*  static update(item){
    RestClient.put("api/user/recipes/"+recipe.id, recipe, function(data){
    toastr.success("Recipe has been updated");
    Recipes.get_all();
    $("#add-recipes").trigger("reset");
    $("#add-recipe *[name='id']").val("");
    $("#add-recipe-modal").modal("hide");
  });
} */

  static pre_edit(id){
    RestClient.get("api/item/"+id, function(data){
     AUtils.json2form("#add-items", data);
     $("#add-items-modal").modal("show");
   });
  }

}
