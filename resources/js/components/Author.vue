<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                      <div class="card-header">
                       <h3 class="card-title text-center"> Registros Author </h3>

                     <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addAuthor" @click="openModalWindow">Crear Author</button>
                      </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                         <thead>
                          <tr>
                           <th scope="col">id</th>
                             <th scope="col">Nombre</th>
                             <th scope="col">Fecha de creacion  </th>
                             <th scope="col">Fecha de actualización</th>
                           </tr>
                          </thead>
                         <tbody>
                            <tr  v-for="(item , index) in authors " :key="index"> 
                             <th>{{item.id}}</th>
                               <td>{{item.name}}</td>
                               <td>{{item.created_at}}</td>
                               <td>{{item.updated_at}}</td>
                             </tr>
                         </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddAuthor" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title">Crear Author </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <div class="modal-body">
                <form @submit.prevent="add">
                    <div class="form-group">
                        <label>Nombre :</label>
                        <input type="text" class="form-control" v-model="author.name">
                        <span v-if="errors.name" class="text-danger">{{errors.name[0]}}</span>
                     </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
          
                 </div>
            </div>
            </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.GetAuthor();
        },
        data(){
            return{
                authors:{},
                errors:[],
                author: {name: ''}
            }
        },
        methods:{
            GetAuthor(){
                axios.get('api/Author')
                 .then(response =>{
                   this.authors = response.data
                 })
            },
             add(){
                 this.errors =[]
                const AuthorNew = this.author;

                axios.post('api/Author',AuthorNew)
                .then(response =>{
                     this.authors = response.data
                    toastr.success('el Author ha sido registrado con exito!');
                     this.author = {name: '',publish_date:'',title:'',author_id:''};    

                    $('#AddAuthor').modal('hide');
                    this.GetAuthor()

                })
                 .catch(error => {
                    if (error.response.sataus = 422) {
                      this.errors =error.response.data.errors
                    }
                    toastr.error('Error');
                })
               
            },
             openModalWindow(){
             $('#AddAuthor').modal('show');  
             }
        }
    }
</script>
