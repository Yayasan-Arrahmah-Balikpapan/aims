<template>
    
    <div class="md:hidden">
        <div class="fixed bottom-0 left-0 z-20 w-full h-16 bg-white border-t border-gray-200">
            <div class="grid h-full grid-cols-4 mx-auto divide-x divide-gray-200 font-medium">
                <button v-for="(tab, index) in tabs" :key="index" @click="activeTab = index"
                    class="inline-flex flex-col items-center justify-center"
                    :class="activeTab === index ? 'text-primary-800' : 'text-gray-700 hover:text-primary-800'">
                    <slot :name="'tab-icon-' + index"></slot>
                    <span class="text-xs">{{ tab . title }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop Tab Navigation -->
    <div class="hidden md:block bg-white">
        <div class="max-w-7xl mx-auto flex border-b border-gray-200 font-extrabold">
            <div v-for="(tab, index) in tabs" :key="index" @click="activeTab = index"
                :class="[
                    'flex items-center justify-between px-6 py-2 font-medium text-sm focus:outline-none transition-colors duration-200',
                    activeTab === index ?
                    'text-primary-800 border-b-2 border-primary-800' :
                    'text-gray-500 hover:text-primary-800'
                ]">
                <slot :name="'tab-icon-' + index"></slot>
                <span class="ml-2 text-md">{{ tab . title }}</span>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div v-for="(tab, index) in tabs" :key="'content-' + index" v-show="activeTab === index">
        <slot :name="'tab-content-' + index"></slot>
    </div>
</template>

<script>
    export default {
        name: 'DynamicTabs',
        props: {
            tabs: {
                type: Array,
                required: true,
                validator: (value) => {
                    return value.every(tab =>
                        tab.title
                    )
                }
            },
            initialTab: {
                type: Number,
                default: 0
            }
        },
        data() {
            return {
                activeTab: this.initialTab
            }
        }
    }
</script>
