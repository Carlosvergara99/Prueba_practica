<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                      <div class="card-header">
                       <h3 class="card-title text-center"> Registros Books </h3>

                     <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#AddBook" @click="openModalWindow">Crear Book</button>
                      </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                         <thead>
                          <tr>
                             <th scope="col">id</th>
                             <th scope="col">Fecha de publicacion</th>
                             <th scope="col">Titulo</th>
                             <th scope="col">Autor</th>
                           </tr>
                          </thead>
                         <tbody>
                            <tr  v-for="(item , index) in books " :key="index"> 
                               <th>{{item.id}}</th>
                               <td>{{item.publish_date}}</td>
                               <td>{{item.title}}</td>
                               <td>{{item.Authors}}</td>
                             </tr>
                         </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddBook" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title">Crear Book </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <div class="modal-body">
                <form @submit.prevent="add">
                    <div class="form-group">
                        <label>Fecha de publicacion :</label>

                      <date-picker  v-model="book.publish_date" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                        <span v-if="errors.publish_date" class="text-danger">{{errors.publish_date[0]}}</span>
                     </div>

                    <div class="form-group">
                    <label>Titulo :</label>
                          <input type="text" class="form-control" v-model="book.title" >
                        <span v-if="errors.title" class="text-danger">{{errors.title[0]}}</span>
                     </div>
                     
                    <div class="form-group">
                        <label>Autor :</label>

                        <select v-model="book.author_id" class="form-control">
                             <option v-for="(item , index) in authors " :key="index" :value="item.id">
                                  {{ item.name }}
                            </option>
                            <option disabled value="">Seleccione</option>
                         </select>
                        <span v-if="errors.author_id" class="text-danger">{{errors.author_id[0]}}</span>

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
  import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        mounted() {
           this.GetBooks();
           this.GetAuthor();
        },
        data(){
            return{
                books:{},
                authors:{},
                errors:[],
                book: {publish_date:'',title:'',author_id:''}
            }
        },
        methods:{   
            add(){
                this.errors =[]

                const BookNew = this.book;
                axios.post('api/Book',BookNew)
                .then(response =>{
                     this.books = response.data
                    toastr.success('el Book ha sido registrado con exito!');
                     this.book = {name: '',publish_date:'',title:'',author_id:''} 

                    $('#AddBook').modal('hide');
                    this.GetBooks();

                })
                 .catch(error => {
                    if (error.response.sataus = 422) {
                      this.errors =error.response.data.errors
                    }
                    toastr.error('Error');
                })

            },
            GetAuthor(){
                axios.get('api/Author')
                 .then(response =>{
                   this.authors = response.data
                 })
            },
            GetBooks(){
                axios.get('api/Book')
                 .then(response =>{
                   this.books = response.data
                 })
            },
             openModalWindow(){
             $('#AddBook').modal('show');
             }
        },
        components: {
      datePicker
    }
        
    }
     
</script>
