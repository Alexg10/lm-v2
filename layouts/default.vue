<template>
  <div>
    <div class="loading-cover" v-if="cover">
      <img :src="cover.acfProjectFields.headerPicture.sourceUrl" alt="cover.acfProjectFields.projectTitle">
    </div>
    <nuxt/>
    <smoothCursor v-if="(!this.$device.ipad) && (!this.$device.mobile)" />
  </div>
</template>

<script>
  import smoothCursor from '~/components/Cursor.vue'
  export default {
    components:{
      smoothCursor
    },
    computed: {
      cover(){
        return this.$store.state.cover;
      }
    }
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
  position: static;
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
