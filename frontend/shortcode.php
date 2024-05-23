<?php

require_once (plugin_dir_path(__FILE__) . '/calculator.php');

function DelusionCalculator()
{

  ob_start(); ?>


  <html>

  <head>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
      href="https://delusionmeter.com//wp-content/plugins/hamja-delusion-calculator/frontend/range.css" />

    <style>
      /* Style for the thumbs */
      .thumb {
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: white;
        transform: translateX(-50%);
        cursor: pointer;
        z-index: 2;
        transition: background-color 0.3s ease;
        top: -3px;
      }

      .thumb:hover {
        background-color: #805ad5;
      }


      .selected {
        background-color: white;
        color: black;
        padding: 5px 20px 5px 20px;
      }


      /* Style for dropdown options */
      #ethnicity-options {
        padding: 0;
        list-style: none;
      }

      #ethnicity-options li {
        padding: 0.5rem 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      #ethnicity-options li:hover {
        background-color: #f3f4f6;
      }

      .align-center {
        align-items: center;
      }

      .gender-label {
        display: flex;
        align-items: center;
        /* Aligns content vertically */
      }

      .gender-radio {
        margin-right: 5px;
        /* Adjust margin as needed */
      }

    </style>

  </head>

  <body>

    <form action="/delusion-calculator-result/" method="POST" class="comment-form">

      <div style="" class="bg-white p-8 rounded-lg shadow max-w-lg mx-auto">
        <div class="text-4xl font-semibold mb-6 text-black">What Percentage of People in United States meet your standards?
        </div>
        <div class="space-y-6">
          <div class="flex items-center">
            <div class="font-medium mb-2 text-black font-bolder">Gender</div>
            <div style="border-radius:5px;" class="flex gap-x-8 align-center bg-[#F4F4F4] ml-auto px-6 py-2">
              <button style="border-radius:5px;" type="button" id="women"
                class="gender-button text-[#766C71] hover:text-black selected">
                Men
              </button>
              <button type="button" id="men" class="gender-button text-[#766C71] hover:text-black">
                Women
              </button>
              <input type="hidden" id="selectedGender" name="gender" value="women">
            </div>

          </div>


          <div class="space-y-6 pb-6">
            <div class="gender-label">
              <label class="text-black" for="obese"><b>Exclude Obese</b></label>
              <div class="flex gap-x-8 align-center bg-[#F4F4F4] ml-auto px-11 py-2">
                <button type="button" id="excludeObeseYes" class="text-[#766C71] hover:text-black obese-button">
                  Yes
                </button>
                <button type="button" id="excludeObeseNo" class="text-[#766C71] hover:text-black selected obese-button">
                  No
                </button>
                <input type="hidden" id="selectedExcludeObese" name="excludeObese" value="no">
              </div>
            </div>
            <div class="gender-label" style="margin-left:auto;">
              <label class="text-black" style="" for="married"><b>Exclude Married</b></label>
              <div class="flex gap-x-8 align-center bg-[#F4F4F4] ml-auto px-11 py-2">
                <button type="button" id="excludeMarriedYes" class="text-[#766C71] hover:text-black married-button">
                  Yes
                </button>
                <button type="button" id="excludeMarriedNo" class="text-[#766C71] hover:text-black selected married-button">
                  No
                </button>
                <input type="hidden" id="selectedExcludeMarried" name="excludeMarried" value="no">
              </div>
            </div>
          </div>

          <div class="py-2">
            <div class="font-medium mb-2 flex">
              <p class="font-bold">Age</p>
              <div style="width: 350px;" slider id="slider-distance">
                <div>
                  <div inverse-left style="width:70%;"></div>
                  <div inverse-right style="width:70%;"></div>
                  <div range style="left:30%;right:40%;"></div>
                  <span thumb style="left:30%;"></span>
                  <span thumb style="left:60%;"></span>
                </div>
                <input type="range" id="minAge" name="ageMin" tabindex="0" value="30" max="100" min="0" step="2" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

                <input type="range" id="maxAge" name="ageMax" tabindex="0" value="60" max="100" min="0" step="2" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />
              </div>
              <div style="">
                <span id="leftThumbValue" style="font-weight:bold;">30</span>
                <span>-</span>
                <span id="rightThumbValue" style="font-weight:bold;">60</span>
              </div>
            </div>


          </div>
        </div>

        <div class="pb-6">
          <div class="font-medium flex">
            <p class="font-bold" style="width:15%">Height</p>
            <div style="width:65%;margin-left:auto; margin-right:5px; width:280px; position:relative; margin-left:auto;" slider
              id="slider-height">
              <div>
                <div inverse-left style="width:70%;"></div>
                <div inverse-right style="width:70%;"></div>
                <div range style="left:30%;right:40%;"></div>
                <span class="thumb drop-shadow-xl" id="leftThumb" style="left:30%; top:-7px;" data-feet="5" data-inches="0"></span>
                <span class="thumb drop-shadow-xl" id="rightThumb" style="left:60%; top:-7px;" data-feet="6" data-inches="0"></span>
              </div>
              <input name="heightMin" id="heightMin" type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
      this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[1].style.width=value+'%';
      children[5].style.left=value+'%';
      children[7].style.left=value+'%';children[11].style.left=value+'%';
    " />

              <input name="heightMax" id="heightMax" type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
      this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[3].style.width=(100-value)+'%';
      children[5].style.right=(100-value)+'%';
      children[9].style.left=value+'%';children[13].style.left=value+'%';
    " />
            </div>
            <div style="width:20%; margin-left:auto;">
              <span id="leftThumbValueH" style="margin-left:auto; font-weight:bold;">2'6''</span>
              <span>-</span>
              <span id="rightThumbValueH" style="font-weight:bold;">5'0''</span>
            </div>
          </div>

        </div>


        <div class="pb-4">
          <div class="font-medium mb-2 flex">
            <p class="font-bold">Income</p>
            <div style="width:280px" slider id="slider-distance">
              <div>
                <div inverse-left style="width:70%;"></div>
                <div inverse-right style="width:70%;"></div>
                <div range style="left:30%;right:40%;"></div>
                <span thumb style="left:30%;"></span>
                <span thumb style="left:60%;"></span>
              </div>
              <input name="minIncome" id="minIncome" type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value * 5;
  " />

              <input name="maxIncome" id="maxIncome" type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value * 5;
  " />
            </div>
            <div>
              <span style="margin-left:auto;">$</span><span id="leftThumbValueI"
                style="font-weight:bold;">30</span><span>K</span>
              <span> - </span>
              <span>$</span><span id="rightThumbValueI" style="font-weight:bold;">60</span><span>K</span>
            </div>
          </div>

        </div>
        <div>
          <div class="flex">
            <div class="font-medium mb-2 font-bold">Ethnicity</div>
            <div class="relative ml-auto">
              <select style="border: 1px solid grey; padding-left:5px;" name="ethnicity" id="ethnicity">
                <option value="white">White</option>
                <option value="black">Black</option>
                <option value="hispanic">Hispanic</option>
                <option value="asian">Asian</option>
                <option value="american-indian-alaska-native">American Indian/Alaska Native</option>
                <option value="other-multiple">Other/Multiple</option>
              </select>
            </div>
          </div>
          <div class="mt-12">
            <button type="submit"
              class="inline-flex justify-between hover:bg-[#FF1D74] text-xl py-8 bg-black text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 w-full py-3">
              Let's Find Out <i class="fa-regular fa-circle-right"></i>
            </button>
          </div>
          <p class="text-center text-sm text-gray-500 mt-4">Calculated using U.S. Census Bureau Data</p>
        </div>

      </div>

      <script>
        // Age Slider
        document.addEventListener("DOMContentLoaded", function () {
          const leftThumbValue = document.getElementById('leftThumbValue');
          const rightThumbValue = document.getElementById('rightThumbValue');

          // Get the sliders
          const leftSlider = document.getElementById('minAge');
          const rightSlider = document.getElementById('maxAge');

          // Update the values initially
          leftThumbValue.textContent = leftSlider.value;
          rightThumbValue.textContent = rightSlider.value;

          // Add event listeners to update the values when sliders are moved
          leftSlider.addEventListener('input', function () {
            leftThumbValue.textContent = parseInt(this.value/2) + 18;
          });

          rightSlider.addEventListener('input', function () {
            rightThumbValue.textContent = parseInt(this.value/2) + 18;
          });
        });

        // Height Slider
        document.addEventListener("DOMContentLoaded", function () {
          const leftThumbValue = document.getElementById('leftThumbValueH');
          const rightThumbValue = document.getElementById('rightThumbValueH');

          // Get the sliders
          const leftSlider = document.getElementById('heightMin');
          const rightSlider = document.getElementById('heightMax');

          // Update the values initially
          leftThumbValue.textContent = `${Math.floor(leftSlider.value / 12)}'${leftSlider.value % 12}''`;
          rightThumbValue.textContent = `${Math.floor(rightSlider.value / 12)}'${rightSlider.value % 12}''`;
          const rightThumbdf = document.getElementById('rightThumb');
          const rightThumbdi = document.getElementById('rightThumb');
          const rightThumbf = document.getElementById('rightThumbFeet');

          const leftThumbdf = document.getElementById('leftThumb');
          const leftThumbdi = document.getElementById('leftThumb');
          const leftThumbf = document.getElementById('leftThumbFeet');

          // Add event listeners to update the values when sliders are moved
          leftSlider.addEventListener('input', function () {
            leftThumbValue.textContent = `${Math.floor((this.value/2) / 12) + 4}'${this.value % 12}''`;
            const leftThumbdf = document.getElementById('leftThumb');
            const leftThumbdi = document.getElementById('leftThumb');
            const leftThumbf = document.getElementById('leftThumbFeet');
          });

          rightSlider.addEventListener('input', function () {
            rightThumbValue.textContent = `${Math.floor((this.value/2) / 12) + 4}'${this.value % 12}''`;
            rightThumbdf.setAttribute('data-feet', Math.floor(this.value / 12));
            rightThumbdi.setAttribute('data-inches', this.value % 12);
            rightThumbf.textContent = `${Math.floor(this.value / 12)}'${this.value % 12}''`;
          });
        });

        // Income Slider
        document.addEventListener("DOMContentLoaded", function () {
          const leftThumbValueI = document.getElementById('leftThumbValueI');
          const rightThumbValueI = document.getElementById('rightThumbValueI');
          console.log("Income Sliders loaded");
          // Get the sliders
          const leftSliderI = document.getElementById('minIncome');
          const rightSliderI = document.getElementById('maxIncome');

          // Update the values initially
          leftThumbValueI.textContent = `${leftSliderI.value * 5}`;
          rightThumbValueI.textContent = `${rightSliderI.value * 5}`;
          console.log(leftThumbValueI.textContent, "MinIncome");
          console.log(rightThumbValueI.textContent, "MaxIncome");
          // Add event listeners to update the values when sliders are moved
          leftSliderI.addEventListener('input', function () {
            leftThumbValueI.textContent = `${this.value * 5}`;
            console.log("Listening to left slider");
          });

          rightSliderI.addEventListener('input', function () {
            rightThumbValueI.textContent = `${this.value * 5}`;
            console.log("Listening to right slider");

          });
        });



        document.addEventListener("DOMContentLoaded", function () {
          const toggleButton = document.getElementById('ethnicity-toggle');
          const optionsList = document.getElementById('ethnicity-options');
          const selectedEthnicity = document.getElementById('selected-ethnicity');

          toggleButton.addEventListener('click', function () {
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
            toggleButton.setAttribute('aria-expanded', !isExpanded);
            optionsList.classList.toggle('hidden');
          });

          optionsList.addEventListener('click', function (event) {
            if (event.target.tagName === 'LI') {
              selectedEthnicity.textContent = event.target.textContent;
              toggleButton.setAttribute('aria-expanded', 'false');
              optionsList.classList.add('hidden');
            }
          });
        });
      </script>


      </div>

    </form>

    <script>
      // Get the gender buttons
      const genderButtons = document.querySelectorAll('.gender-button');

      // Add click event listener to each gender button
      genderButtons.forEach(button => {
        button.addEventListener('click', function () {
          // Set the value of the hidden input to the clicked button's value
          document.getElementById('selectedGender').value = this.id;

          // Check if the button is already selected
          const isSelected = this.classList.contains('selected');
          // If it's not selected, deselect all buttons and select the clicked one
          if (!isSelected) {
            // Reset background color for all buttons
            genderButtons.forEach(btn => {
              btn.classList.remove('selected');
            });
            // Set background color for the clicked button
            this.classList.add('selected');
          } else {
            // If it's already selected, deselect it
            this.classList.remove('selected');
          }
        });
      });

    </script>

<script>
  // Exclude Obese Button
  const excludeObeseButtons = document.querySelectorAll('.obese-button');
  excludeObeseButtons.forEach(button => {
    button.addEventListener('click', function () {
      // Set the value of the hidden input to the clicked button's value
      document.getElementById('selectedExcludeObese').value = this.id.slice(12);

      // Check if the button is already selected
      const isSelected = this.classList.contains('selected');
      // If it's not selected, deselect all buttons and select the clicked one
      if (!isSelected) {
        // Reset background color for all buttons
        excludeObeseButtons.forEach(btn => {
          btn.classList.remove('selected');
        });
        // Set background color for the clicked button
        this.classList.add('selected');
      }
    });
  });

  // Exclude Married Button
  const excludeMarriedButtons = document.querySelectorAll('.married-button');
  excludeMarriedButtons.forEach(button => {
    button.addEventListener('click', function () {
      // Set the value of the hidden input to the clicked button's value
      document.getElementById('selectedExcludeMarried').value = this.id.slice(12);

      // Check if the button is already selected
      const isSelected = this.classList.contains('selected');
      // If it's not selected, deselect all buttons and select the clicked one
      if (!isSelected) {
        // Reset background color for all buttons
        excludeMarriedButtons.forEach(btn => {
          btn.classList.remove('selected');
        });
        // Set background color for the clicked button
        this.classList.add('selected');
      }
    });
  });
</script>


  </body>

  </html>



  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("delusioncalculator_shortcode", "DelusionCalculator");

?>
