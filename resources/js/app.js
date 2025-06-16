import "@protonemedia/laravel-splade/dist/jodit.css";
import "@protonemedia/laravel-splade/dist/style.css";
import 'flowbite';
import "../css/app.css";
import "./bootstrap";

import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import { createApp } from "vue/dist/vue.esm-bundler.js";
import AudioUpload from "./components/AudioUpload.vue";
import BuktiTransferUpload from "./components/BuktiTransferUpload.vue";
import CarouselSlider from "./components/CarouselSlider.vue";
import KtpUpload from "./components/KtpUpload.vue";
import ListBiayaPendaftaran from "./components/ListBiayaPendaftaran.vue";
import Photo from "./components/Photo.vue";
import RecordVoice from "./components/RecordVoice.vue";
import SendOTP from "./components/SendOTP.vue";
import SliderDashboard from "./components/SliderDashboard.vue";
import TahsinDashboardPeriode1 from "./components/tahsin/TahsinDashboardPeriode1.vue";
import TahsinDashboardPeriode2 from "./components/tahsin/TahsinDashboardPeriode2.vue";
import FotoAbsensi from "./components/FotoAbsensi.vue";
import KalenderAbsensiKaryawan from "./components/karyawan/KalenderAbsensiKaryawan.vue";
import InputAbsensiKaryawan from "./components/karyawan/InputAbsensiKaryawan.vue";
import HariTanggalJam from "./components/HariTanggalJam.vue";
import HariTanggalJamKecil from "./components/HariTanggalJamKecil.vue";
import UploadManager from "./components/UploadManager.vue";
import MapMini from "./components/MapMini.vue";
import MapMiniMultiMarker from "./components/MapMiniMultiMarker.vue";

const el = document.getElementById("app");

createApp({
    render: renderSpladeApp({ el })
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true,
        'suppress_compile_errors': true,
        "components": {
            SendOTP,
            Photo,
            SliderDashboard,
            CarouselSlider,
            RecordVoice,
            AudioUpload,
            KtpUpload,
            BuktiTransferUpload,
            ListBiayaPendaftaran,
            TahsinDashboardPeriode1,
            TahsinDashboardPeriode2,
            FotoAbsensi,
            KalenderAbsensiKaryawan,
            InputAbsensiKaryawan,
            HariTanggalJam,
            HariTanggalJamKecil,
            UploadManager,
            MapMini,
            MapMiniMultiMarker,
        },
    })

    .mount(el);
