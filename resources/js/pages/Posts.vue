<template>
    <div>
      <div class="container-fluid">
          <div class="row">
              <div class="col">
                  <h1>Posts</h1>
              </div>
          </div>
          <!-- <div class="row">
              <div class="col">
                  <select name="orderbycolum" id="orderbycolum">
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                    <option value="created_at">Created</option>
                    <option value="updated_at">Updated</option>
                  </select>
                  <select name="orderbysort" id="orderbysort"></select>
              </div>
          </div> -->
          <Main :cards="cards" @changePage="changePage($event)"></Main>
      </div>
  </div>
</template>

<script>
import Axios from "axios";
import Main from '../components/Main.vue';
export default {
    name: 'Posts',
    components: {
        Main
    },
    data() {
      return {
          cards: {
              posts: null,
              next_page_url: null,
              prev_page_url: null
            }
          }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts');
    },
    methods: {
       changePage(vs) {
        let url = this.cards[vs];
        if(url) {
          this.getPosts(url);
        }
      },
      getPosts(url){
            Axios.get(url).then(
              (result) => {
                this.cards.posts = result.data.results.data;
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
              });
        }
    }
}
</script>

<style>

</style>