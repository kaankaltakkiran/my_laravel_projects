<!DOCTYPE html>
<html>
<head>
    <title>Ülke Şehir İlçe Seçimi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Adres Seçimi</h2>

    <form method="POST" action="#">
        @csrf

        <label for="country">Ülke:</label>
        <select id="country" name="country_id">
            <option value="">Seçiniz</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->title }}</option>
            @endforeach
        </select>

        <br><br>

        <label for="city">Şehir:</label>
        <select id="city" name="city_id">
            <option value="">Önce ülke seçiniz</option>
        </select>

        <br><br>

        <label for="district">İlçe:</label>
        <select id="district" name="district_id">
            <option value="">Önce şehir seçiniz</option>
        </select>
    </form>

    <br>
    <p><strong>Seçilen Adres:</strong> <span id="selected-address">Henüz seçim yapılmadı.</span></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedCountry = '';
        let selectedCity = '';
        let selectedDistrict = '';

        function updateAddressText() {
            const fullAddress = [selectedCountry, selectedCity, selectedDistrict]
                .filter(Boolean)
                .join(' / ');
            $('#selected-address').text(fullAddress || 'Henüz seçim yapılmadı.');
        }

        $('#country').on('change', function () {
            let countryId = $(this).val();
            selectedCountry = $(this).find("option:selected").text();
            selectedCity = '';
            selectedDistrict = '';
            updateAddressText();

            $('#city').html('<option>Yükleniyor...</option>');
            $('#district').html('<option>Önce şehir seçiniz</option>');

            if (countryId) {
                $.get(`/get-cities/${countryId}`, function (data) {
                    $('#city').html('<option value="">Seçiniz</option>');
                    $.each(data, function (key, city) {
                        $('#city').append(`<option value="${city.id}">${city.title}</option>`);
                    });
                });
            } else {
                $('#city').html('<option>Önce ülke seçiniz</option>');
            }
        });

        $('#city').on('change', function () {
            let cityId = $(this).val();
            selectedCity = $(this).find("option:selected").text();
            selectedDistrict = '';
            updateAddressText();

            $('#district').html('<option>Yükleniyor...</option>');

            if (cityId) {
                $.get(`/get-districts/${cityId}`, function (data) {
                    $('#district').html('<option value="">Seçiniz</option>');
                    $.each(data, function (key, district) {
                        $('#district').append(`<option value="${district.id}">${district.title}</option>`);
                    });
                });
            } else {
                $('#district').html('<option>Önce şehir seçiniz</option>');
            }
        });

        $('#district').on('change', function () {
            selectedDistrict = $(this).find("option:selected").text();
            updateAddressText();
        });
    </script>
</body>
</html>