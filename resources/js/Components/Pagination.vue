<template>
    <div v-if="links.length > 3">
        <nav>
            <ul class="pagination">
                <template v-for="(link, key) in links">
                    <li
                        v-if="link.url === null"
                        :key="key"
                        class="page-item disabled"
                    >
                        <div class="page-link" v-html="link.label" />
                    </li>
                    <li v-else :key="key + ''" class="page-item" :class="{ 'disabled': link.active }">
                        <inertia-link
                            class="page-link"
                            :href="link.url"
                            v-html="link.label"
                        />
                    </li>
                </template>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
};
</script>