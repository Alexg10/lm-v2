<template>
    <div v-if="project">
        <h1>{{project.title}}</h1>
        <div v-for="bloc in project.acfProjectFields.blocs">
          <component :is="bloc.fieldGroupName.split('_').reverse().shift()" :bloc="bloc"/>
        </div>
    </div>
</template>

<script>
    // Queries
    import project from '~/queries/project'

    // Blocs
    import BlocStep from '~/blocs/BlocStep'
    import BlocTxt from '~/blocs/BlocTxt'

    export default {
        components: {
            BlocStep,
            BlocTxt
        },
        apollo: {
            project : {
                prefetch : true,
                fetchPolicy: 'no-cache',
                query : project,
                variables(){
                    return {
                        slug : this.$route.params.slug
                    }
                },
                update: (data) => data.projectBy
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
