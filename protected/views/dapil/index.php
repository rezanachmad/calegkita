<?php
/* @var $this DapilController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Dapil';
$this->breadcrumbs = array(
    'Dapil',
);
?>
<h1>Pilih Daerah Pemilihan</h1>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="no-ktp">Ketik No. KTP</label>
            <div class="input-group">
                <input id="no-ktp" type="text" class="form-control" placeholder="No. KTP" />
                <span class="input-group-btn">
                    <button id="search-by-no-ktp" onclick="searchByKTP()" class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="address">atau Ketik Alamat</label>
            <div class="input-group">
                <input id="address" type="text" class="form-control" placeholder="Alamat" />
                <span class="input-group-btn">
                    <button id="search-by-address" onclick="codeAddress()" class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div><!-- /input-group -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div style="height: 350px" id="map-canvas"></div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-xs-12 col-md-6">
        <?php echo CHtml::form() ?>
        <?php echo CHtml::hiddenField('nik', '', array('id' => 'nik')); ?>
        <?php echo CHtml::hiddenField('Location[lat]', '', array('id' => 'lat')); ?>
        <?php echo CHtml::hiddenField('Location[long]', '', array('id' => 'long')); ?>
        <button class="btn btn-primary btn-block" type="submit">Lanjutkan</button>
        <?php echo CHtml::endForm() ?>
        </form>
    </div>
</div>


<script type="text/javascript">
    var geocoder;
    var map;
    var marker = null;
    var getAddressURL = '<?php echo Yii::app()->createUrl('api/getAddress', array('nik' => '_nik_')) ?>';
    
    function searchByKTP() {
        var nik = $('#no-ktp').val();
        var url = getAddressURL.replace(/_nik_/, nik);
        $.ajax({
            url: url,
            success: function (data, textStatus, jqXHR) {
                $('#address').val(data);
                $('#nik').val(nik);
                $('#search-by-address').click();
            }
        });
    }

    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-6.873150, 107.586936);
        var mapOptions = {
            zoom: 17,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    }

    function codeAddress() {
        var address = document.getElementById("address").value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var location = results[0].geometry.location;
                map.setCenter(location);
                
                if (marker != null) {
                    marker.setMap(null);
                }
                
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: location
                });
                
                google.maps.event.addListener(marker, 'dragend', function() {
                    location = marker.getPosition();
                    $('#lat').val(location.d);
                    $('#long').val(location.e);
                });
                
                $('#lat').val(location.d);
                $('#long').val(location.e);
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }


    google.maps.event.addDomListener(window, 'load', initialize);
</script>
