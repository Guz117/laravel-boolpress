<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
          <a class="navbar-brand" href="#">
              <img id="logo" class="w-25" :src="logo" alt="logo">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item"  
                v-for="(item) in menuItems"
                :key="item.id"
                >
                  <a class="nav-link" :href="item.link">{{ item.label }}</a>
               </li>
             </ul>
          </div>
      </div>
  </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
      return {
      logo: require('../../img/download.png'),
      menuItems: [
                    {
                        label: 'Home',
                        link: '#',
                        id: 1,
                    },
                    {
                        label: 'Map',
                        link: '#',
                         id: 2,
                    },
                    {
                        label: 'Note',
                        link: '#',
                        id: 3
                    },
                    {
                        label: 'Link',
                        link: '#',
                        id: 4,
                    },
                    {
                        label: 'Contact',
                        link: '#',
                        id: 5,
                    }
                ],
      }
    },
  }
</script>

<style>

</style>