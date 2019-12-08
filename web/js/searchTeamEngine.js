 function myFunction(){
     var teamName = $("#search-team").val() ;


     if (teamName == ""){
         return;
     }
     $.ajax({
         type: "POST",
         url: "/player/searchTeam/"+teamName,
         data: {'teamName' : teamName}
     })
         .done(function( data ) {
             for (let i = 0; i < data.length; i++){
                 $('.team-results').append("<h6>"+data[i][1]+"<h6>");
             }
         });
 };

