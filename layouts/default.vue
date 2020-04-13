<template>
  <div>
    <div class="loading-cover" v-if="cover">
      <img :src="cover.acfProjectFields.headerPicture.sourceUrl" alt="cover.acfProjectFields.projectTitle">
    </div>
    <nuxt/>
    <cursor-fx 
      :config="{
        lerps: {
            dot: 1,
            circle: 0.18,
            custom: 0.23,
        },
        scale: {
            ratio: 0.18,
            min: 1,
            max: 0.5,
        },
        opacity: 0.1,
      }" 
      color="#FF9170" 
      color-hover="#FF9170" 
      outside-size="45px" 
      :hide-inside="true" >
    </cursor-fx>
  </div>
</template>

<script>
  import { CursorFx } from '@luxdamore/vue-cursor-fx';
  import '@luxdamore/vue-cursor-fx/dist/CursorFx.css';
  export default {
    components:{
      'cursor-fx': CursorFx,
    },
    computed: {
      cover(){
        return this.$store.state.cover;
      }
    },
    mounted() {

    },
  }
</script>

<style lang="scss">
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
}

.loading-cover {
  // opacity: 0;
  position: fixed;
  z-index: 999;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;

  img {
    height: 100%;
    width: 100%;
    object-fit: cover;
  }
}
</style>
