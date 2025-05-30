<template>
    <div class="space-y-4">
        <!-- Upload Box -->
        <FilePond
            name="file"
            ref="pond"
            class="filepond"
            :server="pondServer"
            :allow-multiple="true"
            :allow-image-preview="true"
            :accepted-file-types="acceptedTypes"
            :max-file-size="maxSize"
            :label-idle="labelIdle"
        />

        <!-- Search Box -->
        <div class="flex justify-between items-center">
            <div class="relative w-64">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Cari file..."
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    @input="handleSearch"
                >
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Uploaded Files Table -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Attached Files</h2>

            <div v-if="loading" class="text-center py-8">
                <span class="animate-spin inline-block w-6 h-6 border-2 border-blue-500 border-t-transparent rounded-full"></span>
                <p class="mt-2 text-gray-600">Loading files...</p>
            </div>

            <div v-else>
                <div v-if="files.data.length === 0" class="text-center py-8 text-gray-500">
                    No files found
                </div>

                <div v-else class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-2">Preview</th>
                                <th class="p-2">File Name</th>
                                <th class="p-2">File Size</th>
                                <th class="p-2">Uploaded At</th>
                                <th class="p-2">Uploaded By</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="file in files.data" :key="file.id" class="border-b hover:bg-gray-50">
                                <td class="p-2">
                                    <img
                                        v-if="file.thumbnail && isImage(file.type)"
                                        :src="file.thumbnail"
                                        class="w-16 h-16 object-cover rounded"
                                        :alt="file.name"
                                    >
                                    <div v-else class="w-16 h-16 flex items-center justify-center bg-gray-100 rounded">
                                        <span v-if="isPDF(file.type)" class="text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                        <span v-else class="text-gray-500">No Preview</span>
                                    </div>
                                </td>
                                <td class="p-2">
                                    <input
                                        v-if="file.editing"
                                        v-model="file.new_name"
                                        @keyup.enter="saveFileName(file)"
                                        @blur="saveFileName(file)"
                                        class="border p-1 w-full"
                                    >
                                    <span v-else @dblclick="startEditing(file)">{{ file.name }}</span>
                                </td>
                                <td class="p-2">{{ formatSize(file.size) }}</td>
                                <td class="p-2">{{ formatDate(file.created_at) }}</td>
                                <td class="p-2">{{ file.uploaded_by }}</td>
                                <td class="p-2 space-x-2">
                                    <button
                                        @click="copyUrl(file.url)"
                                        class="text-blue-600 hover:underline px-2 py-1 bg-blue-50 rounded"
                                    >
                                        Copy URL
                                    </button>
                                    <button
                                        @click="downloadFile(file)"
                                        class="text-green-600 hover:underline px-2 py-1 bg-green-50 rounded"
                                    >
                                        Download
                                    </button>
                                    <button
                                        @click="deleteFile(file.id)"
                                        class="text-red-600 hover:underline px-2 py-1 bg-red-50 rounded"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4" v-if="files.meta && files.meta.total > 0">
                    <div class="text-sm text-gray-600">
                        Showing {{ files.meta.from }} to {{ files.meta.to }} of {{ files.meta.total }} entries
                    </div>
                    <div class="flex space-x-1">
                        <button
                            @click="fetchFiles(files.meta.current_page - 1)"
                            :disabled="files.meta.current_page === 1"
                            class="px-3 py-1 border rounded disabled:opacity-50"
                        >
                            Previous
                        </button>
                        <button
                            v-for="page in visiblePages"
                            :key="page"
                            @click="fetchFiles(page)"
                            :class="{'bg-blue-500 text-white': page === files.meta.current_page}"
                            class="px-3 py-1 border rounded"
                        >
                            {{ page }}
                        </button>
                        <button
                            @click="fetchFiles(files.meta.current_page + 1)"
                            :disabled="files.meta.current_page === files.meta.last_page"
                            class="px-3 py-1 border rounded disabled:opacity-50"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import vueFilePond from 'vue-filepond'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css'
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const FilePond = vueFilePond(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType
)

// Configuration
const acceptedTypes = ['image/*', 'video/*', 'application/pdf', 'application/msword']
const maxSize = '10MB'
const labelIdle = 'Klik upload file'
const searchQuery = ref('')
const api_token = ref(localStorage.getItem('token') || '')
const loading = ref(false)
const debounceTimeout = ref(null)

const pondServer = {
    process: {
        url: '/api/media-upload',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Authorization': `Bearer ${api_token.value}`,
        },
        onload: (res) => {
            fetchFiles()
        },
        onerror: (err) => {
            console.error('Upload Error:', err)
        }
    },
    revert: null
}

const files = ref({
    data: [],
    meta: null
})

// Computed
const visiblePages = computed(() => {
    if (!files.value.meta) return []
    const current = files.value.meta.current_page
    const last = files.value.meta.last_page
    const delta = 2
    const range = []

    for (let i = Math.max(2, current - delta); i <= Math.min(last - 1, current + delta); i++) {
        range.push(i)
    }

    if (current - delta > 2) range.unshift('...')
    if (current + delta < last - 1) range.push('...')

    range.unshift(1)
    if (last !== 1) range.push(last)

    return range
})

// Methods
const fetchFiles = async (page = 1) => {
    try {
        loading.value = true
        const res = await axios.get('/api/media-list', {
            params: {
                // page: page,
                search: searchQuery.value
            },
            headers: {
                'Authorization': `Bearer ${api_token.value}`
            }
        })

        console.log('Raw data:', res.data.original);
        files.value = {
            data: res.data.original.data.map(file => ({
                ...file,
                editing: false,
                new_name: file.name
            })),
            meta: res.data.original.meta
        }
    } catch (error) {
        console.error('Error fetching files:', error)
        // alert('Failed to load files')
    } finally {
        loading.value = false
    }
}

const handleSearch = () => {
    clearTimeout(debounceTimeout.value)
    debounceTimeout.value = setTimeout(() => {
        fetchFiles()
    }, 500)
}

const startEditing = (file) => {
    file.editing = true
}

const saveFileName = async (file) => {
    try {
        await axios.put(`/api/media-update/${file.id}`, {
            name: file.new_name
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Authorization': `Bearer ${api_token.value}`
            }
        })
        file.name = file.new_name
        file.editing = false
    } catch (error) {
        console.error('Error updating file name:', error)
        file.new_name = file.name
        file.editing = false
        alert('Failed to update file name')
    }
}

const copyUrl = async (url) => {
    try {
        await navigator.clipboard.writeText(url)
        alert('URL copied to clipboard!')
    } catch (err) {
        console.error('Failed to copy URL:', err)
        // Fallback for browsers that don't support clipboard API
        const textarea = document.createElement('textarea')
        textarea.value = url
        document.body.appendChild(textarea)
        textarea.select()
        document.execCommand('copy')
        document.body.removeChild(textarea)
        alert('URL copied to clipboard!')
    }
}

const downloadFile = (file) => {
    const link = document.createElement('a')
    link.href = file.url
    link.download = file.name
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
}

const deleteFile = async (id) => {
    if (!confirm('Are you sure you want to delete this file?')) return

    try {
        await axios.delete(`/api/media-delete/${id}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Authorization': `Bearer ${api_token.value}`
            }
        })
        fetchFiles(files.value.meta.current_page)
    } catch (error) {
        console.error('Error deleting file:', error)
        alert('Failed to delete file')
    }
}

const formatSize = (bytes) => {
    if (bytes === 0) return '0 Bytes'
    const k = 1024
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
    const i = Math.floor(Math.log(bytes) / Math.log(k))
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
    return new Date(dateString).toLocaleDateString(undefined, options)
}

const isImage = (mimeType) => {
    return mimeType?.startsWith('image/')
}

const isPDF = (mimeType) => {
    return mimeType === 'application/pdf'
}

// Lifecycle
onMounted(() => {
    fetchFiles()
})
</script>

<style scoped>
.filepond {
    margin-bottom: 1rem;
}

input[type="text"] {
    transition: all 0.3s ease;
}

input[type="text"]:focus {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
