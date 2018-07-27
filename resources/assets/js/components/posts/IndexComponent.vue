<template>
	<div >
		<div style = "margin-left:3%">
			<h3 class="border-bottom">Posts</h3>
			<i @click="clearList" data-toggle="modal" data-target="#modalAddPost" class="fa fa-plus btn" aria-hidden="true" style="font-size: 200%;"  ></i>
		</div>

		<table class="table table-striped mt-3" style = "margin-left:3%">
			<thead>
		    	<tr>
		    		<th scope="col">#</th>
		      		<th scope="col">Post Name</th>
		      		<th scope="col">Post</th>
		      		<th scope="col">Edit</th>
		      		<th scope="col">Delete</th>
		    	</tr>
		  	</thead>
		  	<tbody v-for="(post, index) in posts ">
		    	<tr>
		      		<th scope="row">{{index+1}}</th>
		      		<td>
		      			<a  v-bind:href="'/posts/' + post.id">{{post.post_name}}</a>
		      		</td>
					<td>{{post.post}}</td>
					<td>
						<button type = "button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditPost" @click="actionEdit(post.id,post.post_name,post.post)">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
					</td>
		      		<td>
		      			<button type="button" class="btn btn-danger" @click="actionPost(post.id)" >
		      				<i class="fa fa-trash-o" aria-hidden="true"></i>
		      			</button>
		      		</td>
		    	</tr>
		  	</tbody>
		</table>

		<!----------------------------------Start Add post modal  ------------------------>
		<div class="modal fade" id="modalAddPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header text-center">
		                <h4 class="modal-title w-100 font-weight-bold">Add post</h4>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body mx-3">
		            	<div class="form-group">
	                		<input type="text" class="form-control" placeholder="Post Name" v-model="list.post_name">
	                		<div v-if= "postError.post_name != ''" class="alert alert-danger">{{postError.post_name}}</div>
						</div>
						<div class="form-group">
	                		<input type="text" class="form-control" placeholder="Post" v-model="list.post">
	                		<div v-if= "postError.post != ''" class="alert alert-danger">{{postError.post}}</div>
						</div>
		            </div>
		            <div class="modal-footer d-flex">
		            	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                		<button type="button" class="btn btn-primary" @click="store">Add post</button>
		            </div>
		        </div>
		    </div>
		</div>
		<!----------------------------------End Add post modal  ------------------------>


		<!----------------------------------Start Edit post modal  ------------------------>
		<div class="modal fade" id="modalEditPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header text-center">
		                <h4 class="modal-title w-100 font-weight-bold">Edit post</h4>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body mx-3">
	            		<div>
	                		<input type="hidden" name="" placeholder="Post Name" :value="list.post_id">
	                	</div>
	                	<div class="form-group">
	                		<input type="text" class="form-control" placeholder="Post Name" v-model="list.post_name">
	                		<div v-if= "postError.post_name != ''" class="alert alert-danger">{{postError.post_name}}</div>
						</div>
						<div class="form-group">
	                		<input type="text" class="form-control" placeholder="Post" v-model="list.post">
	                		<div v-if= "postError.post != ''" class="alert alert-danger">{{postError.post}}</div>
						</div>
		            </div>
		            <div class="modal-footer d-flex ">
		            	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                		<button type="button" class="btn btn-primary" @click="editPost">Save changes</button>
		            </div>
		        </div>
		    </div>
		</div>
		<!----------------------------------Start Edit post modal  ------------------------>

	</div>


</template>


<script>
    export default {
    	data() {
    		return {
    			list: {
    				post_id: '',
    				post_name: '',
    				post: '',
    			},
    			postError: {
    				post_name: '',
    				post: '',
    			
    			},
    		}
    	},

        props: ['posts'],

        methods: {
        	store() {
        		axios.post('/posts',this.list)
        		.then((response) =>{
        			if(response.status == 201){
        				location.reload();
        			}
        		})
	    		.catch((error) =>  {
	    		 	if(error.response.status == 422){
	    		 		this.postError = error.response.data.errors;
	        			if(this.postError.post === undefined){
	        				this.postError.post = '';
	        			}
	        			if(this.postError.post_name === undefined){
	        				this.postError.post_name = '';
	        			}
	    		 	}
	    		 	else{
	    		 		location.reload();
	    		 	}
	    			
	    		})
        	},

        	deletePost(id) {
        		
        		axios.delete('/posts/'+id)
       			.then(() => location.reload());
        	},

        	actionPost(id) {
        		confirm('Are you sure?') ? this.deletePost(id) : null;
        	},

        	actionEdit(id,name,post) {
        		this.list.post_id = id;
        		this.list.post_name = name;
        		this.list.post = post;
        		this.postError = {
    				post_name: '',
    				post: '',
    			
    			};
        	},

        	editPost(){
        		axios.put('/posts/'+this.list.post_id, this.list)
        		.catch((error) =>  {
        		 	if(error.response.status == 422){
        		 		this.postError = error.response.data.errors;
	        			if(this.postError.post === undefined){
	        				this.postError.post = '';
	        			}
	        			if(this.postError.post_name === undefined){
	        				this.postError.post_name = '';
	        			}
        		 	}
        		 	else{
        		 		location.reload();
        		 	}
        			
        		 })
        	},
        	clearList(){
        		this.list = {
    				post_id: '',
    				post_name: '',
    				post: '',
    			};
    			this.postError = {
    				post_name: '',
    				post: '',
    			
    			};
        	},
        }
    }
</script>