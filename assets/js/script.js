$(function () {

    // $('#startDate').datepicker({
    //     maxDate: function () {
    //         return $('#endDate').val();
    //     }
    // });
    // $('#endDate').datepicker({
    //     minDate: function () {
    //         return $('#startDate').val();
    //     }
    // });

    $('.ubahmodalP').on('click', function () {


        $('.modal-body form').attr('action', 'http://www.proyek.cvphiliakami.com/kelola_proyek/ubah');

        const kode_proyek = $(this).data('kode_proyek');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Kelola_Proyek/getubah',
            data: { kode_proyek: kode_proyek },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data); 
                // $('#kode_proyek').type('hidden');
                $('#ukode_proyek').val(data.kode_proyek);
                $('#unama_proyek').val(data.nama_proyek);
                $('#ualamat_proyek').val(data.alamat_proyek);
                $('#ubiaya_proyek').val(data.biaya_proyek);
                //    var timem : strtotime(data.tanggal_mulai);
                //    var tanggalm : date('m/d/Y', timem);
                //    var times : strtotime(data.tanggal_selesai);
                //    var tanggals : date('m/d/Y', $times);
                // var parts = data.tanggal_mulai.split('-');
                // // Please pay attention to the month (parts[1]); JavaScript counts months from 0:
                // // January - 0, February - 1, etc.
                // var mydate = new Date(parts[0], parts[1] - 1, parts[2]);
                // var d = Date(data.tanggal_mulai);
                // var myformat = new SimpleDateFormat("MM/DD/YYYY");
                // console.log(myformat.format(d));
                $('#ustartDate').val(data.tanggal_mulai);
                $('#uendDate').val(data.tanggal_selesai);
                $('#ulama_proyek').val(data.lama_proyek);
            }
        });

    });

    $('.hapusmodalP').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Kelola_Proyek/gethapusP',
            data: { kode_proyek: kode_proyek },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data.kode_proyek);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hnama_proyek').val(data.nama_proyek);
            }
        });
    });

    $('.ubahmodalPK').on('click', function () {
        $('#ubahPKModalLabel').html('Ubah Data Pekerjaan');

        const kode_proyek = $(this).data('kode_proyek');
        const kode_pekerjaan = $(this).data('kode_pekerjaan');
        // console.log(kode_proyek);

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Kelola_Pekerjaan/getubahPK',
            data: { kode_proyek: kode_proyek, kode_pekerjaan: kode_pekerjaan },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#ukode_proyek').val(data.kode_proyek);
                $('#ukode_pekerjaan').val(data.kode_pekerjaan);
                $('#unama_pekerjaan').val(data.nama_pekerjaan);
                $('#ubobot').val(data.bobot);
            }
        });

    });

    $('.hapusmodalPK').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_pekerjaan = $(this).data('kode_pekerjaan');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Kelola_Pekerjaan/gethapusPK',
            data: { kode_proyek: kode_proyek, kode_pekerjaan: kode_pekerjaan },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hkode_pekerjaan').val(data.kode_pekerjaan);
                $('#hnama_pekerjaan').val(data.nama_pekerjaan);
            }
        });
    });



    $('.ubahmodalRE').on('click', function () {
        $('#ubahREModalLabel').html('Ubah Data Risk Event');

        const kode_proyek = $(this).data('kode_proyek');
        const kode_risk_event = $(this).data('kode_risk_event');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/getubahRE',
            data: { kode_proyek: kode_proyek, kode_risk_event: kode_risk_event },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#ukode_proyek').val(data.kode_proyek);
                $('#ukode_risk_event').val(data.kode_risk_event);
                $('#urisk_event').val(data.risk_event);
                $('#useverity').val(data.severity);
            }
        });

    });

    $('.hapusmodalRE').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_risk_event = $(this).data('kode_risk_event');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/gethapusRE',
            data: { kode_proyek: kode_proyek, kode_risk_event: kode_risk_event },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hkode_risk_event').val(data.kode_risk_event);
                $('#hrisk_event').val(data.risk_event);
            }
        });
    });




    $('.ubahmodalRA').on('click', function () {
        $('#ubahRAModalLabel').html('Ubah Data Risk Agent');

        const kode_proyek = $(this).data('kode_proyek');
        const kode_risk_agent = $(this).data('kode_risk_agent');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/getubahRA',
            data: { kode_proyek: kode_proyek, kode_risk_agent: kode_risk_agent },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#ukode_proyek').val(data.kode_proyek);
                $('#ukode_risk_agent').val(data.kode_risk_agent);
                $('#urisk_agent').val(data.risk_agent);
                $('#uoccurence').val(data.occurence);
            }
        });

    });

    $('.hapusmodalRA').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_risk_agent = $(this).data('kode_risk_agent');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/gethapusRA',
            data: { kode_proyek: kode_proyek, kode_risk_agent: kode_risk_agent },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hkode_risk_agent').val(data.kode_risk_agent);
                $('#hrisk_agent').val(data.risk_agent);
            }
        });
    });




    $('.ubahmodalM').on('click', function () {
        $('#ubahMModalLabel').html('Ubah Data Mitigasi');

        const kode_proyek = $(this).data('kode_proyek');
        const kode_mitigasi = $(this).data('kode_mitigasi');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/getubahM',
            data: { kode_proyek: kode_proyek, kode_mitigasi: kode_mitigasi },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#ukode_proyek').val(data.kode_proyek);
                $('#ukode_mitigasi').val(data.kode_mitigasi);
                $('#umitigasi').val(data.mitigasi);
                $('#udifficulty').val(data.difficulty);
            }
        });

    });

    $('.hapusmodalM').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_mitigasi = $(this).data('kode_mitigasi');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Manajemen_Risiko/gethapusM',
            data: { kode_proyek: kode_proyek, kode_mitigasi: kode_mitigasi },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hkode_mitigasi').val(data.kode_mitigasi);
                $('#hmitigasi').val(data.mitigasi);
            }
        });
    });


    $('.ubahmodalU').on('click', function () {
        $('#ubahUModalLabel').html('Ubah Data User');

        const id = $(this).data('id');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/admin/getU',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#uid').val(data.id);
                $('#unama').val(data.nama);
                $('#uemail').val(data.email);
                $('#urole_id').val(data.role_id);
                $('#ustatus_aktif').val(data.status_aktif);
            }
        });

    });

    $('.hapusmodalU').click(function () {

        const id = $(this).data('id');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/admin/getU',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#hid').val(data.id);
                $('#hnama').val(data.nama);
            }
        });
    });


    $('.ubahmodalPP').on('click', function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_pekerjaan = $(this).data('kode_pekerjaan');
        const tanggal = $(this).data('tanggal');

        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Progress_Proyek/getubahPP',
            data: { kode_proyek: kode_proyek, kode_pekerjaan: kode_pekerjaan, tanggal: tanggal },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                console.log(data.kode_pekerjaan);
                $('#ukode_proyek').val(data.kode_proyek);
                $('#ukode_pekerjaan').val(data.kode_pekerjaan);
                $('#utanggal').val(data.tanggal);
                $('#ubobot_realisasi').val(data.bobot_realisasi);
            }
        });

    });

    $('.hapusmodalPP').click(function () {

        const kode_proyek = $(this).data('kode_proyek');
        const kode_pekerjaan = $(this).data('kode_pekerjaan');
        const tanggal = $(this).data('tanggal');
        $.ajax({
            url: 'http://www.proyek.cvphiliakami.com/Progress_Proyek/gethapusPP',
            data: { kode_proyek: kode_proyek, kode_pekerjaan: kode_pekerjaan, tanggal: tanggal },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#datasatu').html('Kode Proyek = ' + data.kode_proyek);
                $('#datadua').html('Kode Pekerjaan = ' + data.kode_pekerjaan);
                $('#datatiga').html('Tanggal = ' + data.tanggal);
                $('#hkode_proyek').val(data.kode_proyek);
                $('#hkode_pekerjaan').val(data.kode_pekerjaan);
                $('#htanggal').val(data.tanggal);
            }
        });
    });


});