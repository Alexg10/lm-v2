<template>
    <div v-if="project">
        <h1>{{project.title}}</h1>
        <!-- {{project.acfProjectFields.blocs}} -->
    </div>
</template>

<script>

    import project from '~/queries/project'

    export default {

        apollo: {
            project : {
                prefetch : true,
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