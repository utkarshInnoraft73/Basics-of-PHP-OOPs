<?php

/**
 * PHP starts here.
 */
//Import the Field Class.
require("./FIelds/Fields.php");

/**
 * @var string BASEUPL.
 *   Base url of the.
 */
define("BASEURL", "https://www.innoraft.com");
$fieldArray = fieldServices();

/**
 * To Store the all fetched data from API.
 * 
 * @var string fieldTitle.
 *   Stores the service field title. 
 * @var string fieldService.
 *   Stores the all services URLs of a particular field.
 * @var string fieldImage.
 *   Stores the image URL of a particular field.
 * @var string alias.
 *   Stores the URL for particular field for more detail about that service.
 * @var array iconArr.
 *   Stores URLs of the icons for a particular field of service.
 * 
 * @return array fieldArray.
 *   Stores the all fetched data in the form of array.
 */
function fieldServices()
{
  $fieldArray = [];
  $arrBody = (new FetchApi('https://www.innoraft.com/jsonapi/node/services'))->apiCall();

  foreach ($arrBody['data'] as $data) {

    //Check if the field title is not null.
    if ($data['attributes']['field_secondary_title'] != NULL) {
      $iconsArr = [];
      $fieldTitle = $data['attributes']['field_secondary_title']['value'];
      $fieldService =  $data['attributes']['field_services']['value'];
      $fieldImage = BASEURL . (new FetchApi($data['relationships']['field_image']['links']['related']['href']))->apiCall()['data']['attributes']['uri']['url'];
      $alias = BASEURL . $data['attributes']['path']['alias'];
      $fieldIcons = (new FetchApi($data['relationships']['field_service_icon']['links']['related']['href']))->apiCall()['data'];

      for ($i = 0; $i < count($fieldIcons); $i++) {
        $iconsArr[] = BASEURL . (new FetchApi($fieldIcons[$i]['relationships']['field_media_image']['links']['related']['href']))->apiCall()['data']['attributes']['uri']['url'];
      }
      $fieldArray[] = new Field($fieldImage, $fieldTitle, $alias, $fieldService, $iconsArr);
    }
  }
  return $fieldArray;
}
/**
 * PHP ends here.
 */
?>

<!-- HTML starts here. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./Styles/style.css">
</head>

<body>
  <section class="services">
    <div class="container">

      <!-- Openning the for loop to display the data. -->
      <?php for ($i = 0; $i < count($fieldArray); $i++) {

        $indexedEle = $fieldArray[$i];
        // Checking the field title is empty or not.
        if (!empty($indexedEle->getFieldTitle())) {

          //Check if the field index is even.
          if ($i % 2 == 0) {
      ?>
            <div class="serviceContainer d-flex justify-content-center align-item-center">
              <div class="itemLinks">
                <h2>
                  <?php echo $indexedEle->getFieldTitle(); ?>
                </h2>
                <div class="servicesIcons d-flex">
                  <?php
                  for ($j = 0; $j < $indexedEle->getFieldIconsLen(); $j++) { ?>

                    <div class="links">
                      <img class="icon" src="<?php echo $indexedEle->getFieldIcons()[$j]; ?>">
                    </div>
                  <?php } ?>
                </div>
                <div class="links">
                  <?php echo $indexedEle->getFieldService(); ?>
                </div>
                <a class="btn" href="<?php echo $indexedEle->getAlias(); ?>">Explore More</a>
              </div>
              <div class="itemImg">
                <img src="<?php echo $indexedEle->getFieldImage(); ?>">
              </div>
            </div>
          <?php }

          // If field index is not even.
          else { ?>
            <div class="serviceContainer d-flex justify-content-center align-item-center">
              <div class="itemImg">
                <img src="<?php echo $indexedEle->getFieldImage(); ?>">
              </div>
              <div class="itemLinks">
                <h2>
                  <?php echo $indexedEle->getFieldTitle(); ?>
                </h2>
                <div class="servicesIcons d-flex">
                  <?php
                  for ($j = 0; $j < $indexedEle->getFieldIconsLen(); $j++) { ?>
                    <div class="links">
                      <img class="icon" src="<?php echo $indexedEle->getFieldIcons()[$j]; ?>">
                    </div>
                  <?php } ?>
                </div>
                <div class="links">
                  <?php echo $indexedEle->getFieldService(); ?>
                </div>
                <a class="btn" href="<?php echo $indexedEle->getAlias(); ?>">Explore More</a>
              </div>
            </div>
      <?php }
        }
      } ?>
    </div>
  </section>
</body>

</html>

<!-- HTML ends here. -->