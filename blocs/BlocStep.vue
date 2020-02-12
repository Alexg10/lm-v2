<template>

    <section class="chapter" v-bind:style='{backgroundColor: bloc.bg_color}'>
        <div class="container">
            <div class="project-chapter">
                <span class="number">{{bloc.number}}.</span>
            </div>
            <div class="project-category">
                <span class="project-category-name">{{bloc.name}}</span>
            </div>
        </div>
    </section>
</template>

<script>
  export default {
    props: [
      'bloc'
    ]
  }
</script>

<style lang="scss" scoped>
  .chapter{
      padding-top: 83px;
      padding-bottom: 40px;
      text-align: center; 
  }
  .project-chapter{
    font-family: 'GTWalsheimProBold';
    text-transform: uppercase;
    letter-spacing: 2px;
    // color: $grey;
    color: #B4B3B1;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .project-category{
      font-family: 'GTWalsheimProBold';
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: bold;
      overflow: hidden;
  }
  .project-chapter{
      position: relative;
      overflow: hidden;
  }
  .number,
  .project-category-name{
      display: block;
  }
</style>