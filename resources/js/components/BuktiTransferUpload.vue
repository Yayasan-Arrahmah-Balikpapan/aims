<template>
  <div>
    <file-pond
      ref="pond"
      name="buktitransfer"
      label-idle="<span class='filepond--label-action'> Klik untuk upload file Bukti Transfer</span>"
      allow-multiple="false"
      :server="{
        url: uploadUrl,
        process: {
            headers: {
            'X-CSRF-TOKEN': csrfToken
            }
        }
      }"
      image-resize-target-width="700"
      image-resize-mode="cover"
      @init="handleFilePondInit"
      @processfile="handleFileUpload"
    />

    <!-- Div yang akan muncul setelah upload selesai -->
    <div v-show="showUploadedContent" class="uploaded-content">
      <slot name="uploaded-content"></slot>
    </div>
  </div>
</template>

<script>
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import "filepond/dist/filepond.min.css";
import vueFilePond from "vue-filepond";

const FilePond = vueFilePond(
  FilePondPluginFileEncode,
  FilePondPluginImagePreview,
  FilePondPluginImageResize
);

export default {
  props: {
    uploadUrl: {
      type: String,
      required: true
    }
  },
  components: {
    FilePond
  },
  data() {
    return {
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      showUploadedContent: false // State untuk mengontrol tampilan div
    }
  },
  methods: {
    handleFilePondInit() {
      console.log("FilePond has initialized");
      this.showUploadedContent = false; // Pastikan hidden saat inisialisasi
    },
    handleFileUpload(error, file) {
      if (error) {
        console.error("Error during file upload:", error);
        this.showUploadedContent = false; // Tetap hidden jika error
      } else {
        console.log("File uploaded successfully:", file.serverId);
        this.showUploadedContent = true; // Tampilkan div setelah upload sukses

        // Emit event ke parent component jika diperlukan
        this.$emit('upload-complete', file.serverId);
      }
    }
  }
};
</script>

<style>
@import "filepond/dist/filepond.min.css";

.filepond--media-preview-wrapper {
  position: absolute;
}

.filepond--media-preview {
  padding-top: 30px;
}

/* Style untuk div yang muncul setelah upload */
.uploaded-content {
  margin-top: 20px;
  padding: 15px;
  text-align: center;
  transition: all 0.3s ease;
}
</style>
