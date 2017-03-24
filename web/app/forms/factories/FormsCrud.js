"use strict";

angular.module('app').factory('FormsCrud', function($http,$state)
{
        return {
                nuevo:function(params,rutas,vars){
                    if (params.submited===true)
                    {
                        return $http({
                                          method  : 'POST',
                                          async:   true,
                                          url     : Routing.generate(rutas.create,vars),
                                          data    : params.formData,  // pass in data as strings
                                          transformRequest: angular.identity,
                                          headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                         }).then(function(response) { 
                                            // console.log(response);
                                                if(response.status===200){
                                                  return response.data;  
                                                }else if(response.status===201)
                                                {   
                                                    $state.go(rutas.state_created,{id:response.data.id});
                                                    return "<div>se ha guardado correctamente</div>";
                                                }
                                              });
                    }else{
                                    return $http.get(Routing.generate(rutas.new,vars))
                                         .then(function(response) {
                                          return response.data;
                                           });
                                       }
                                 },
                 edit:function(params,rutas,vars){
                    if (params.submited===true)
                    {
                        return $http({
                                          method  : 'POST',
                                          async:   true,
                                          url     : Routing.generate(rutas.update,{'id':params.id}),
                                          data    : params.formData,  // pass in data as strings
                                          transformRequest: angular.identity,
                                          headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                         }).then(function(response) { 
                                            // console.log(response);
                                                if(response.status===200){

                                                  return response.data;  
                                                }else if(response.status===201)
                                                {   
                                                    $state.go(rutas.state_updated,{id:response.data.id});
                                                    return "<div>se ha actualizado correctamente</div>";
                                                }
                                              });
                    }else{
                                    return $http.get(Routing.generate(rutas.edit,{'id':params.id}))
                                         .then(function(response) {
                                          return response.data;
                                           });
                                       }},  
                 editWithVars:function(params,rutas,vars){
                    if (params.submited===true)
                    {
                        return $http({
                                          method  : 'POST',
                                          async:   true,
                                          url     : Routing.generate(rutas.update,vars),
                                          data    : params.formData,  // pass in data as strings
                                          transformRequest: angular.identity,
                                          headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                         }).then(function(response) { 
                                            // console.log(response);
                                                if(response.status===200){

                                                  return response.data;  
                                                }else if(response.status===201)
                                                {   
                                                    //$state.go(rutas.state_updated,{id:response.data.id});
                                                    return "<div>se ha actualizado correctamente</div>";
                                                }
                                              });
                    }else{

                                    return $http.get(Routing.generate(rutas.edit,vars))
                                         .then(function(response) {
                                          return response.data;
                                           });
                                       }}                     
               };
        }
    );



