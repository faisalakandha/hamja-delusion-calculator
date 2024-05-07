<?php

require_once (plugin_dir_path(__FILE__) . '/calculator.php');

function DelusionCalculator()
{

  $test_data = [
    'age_range' => [25, 35],  // Age range between 25 and 35
    'income_slider' => 75000,   // Minimum income of $75,000
    'race' => 'White',  // Selected races: White and Asian
    'height_feet' => 5,
    'height_inches' => 11,
    'gender_preference' => 'Male', // Optional: Male partner preference
    'exclude_obese' => true,    // Optional: Exclude obese individuals
  ];

  $results = calculate_dating_pool($test_data);

  ob_start(); ?>


  <html>

  <head>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
      href="http://wp.docker.localhost:8000/wp-content/plugins/hamja-delusion-calculator/frontend/range.css" />

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
        background-color: black;
        /* or any other desired background color */
        color: white;
        /* adjust text color if needed */
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
    </style>

  </head>

  <body>

    <form action="/test-form-data/" method="POST" class="comment-form">

      <div style="box-shadow: 0px 20px 20px 0px lightblue;" class="bg-white p-8 rounded-lg shadow max-w-md mx-auto">
        <h2 class="text-2xl font-semibold mb-6">What Percentage of People in United States meet your standards?</h2>
        <div class="space-y-6">
          <div>
            <p class="font-medium mb-2">Gender</p>
            <div class="flex gap-2">
              <input type="button" id="men" name="men"
                class="inline-flex gender-button hover:bg-black hover:text-white border border-input items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 flex-1 cursor-pointer"
                value="Men" Men />
              <input type="button" id="women" name="women"
                class="inline-flex gender-button hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex-1 cursor-pointer"
                value="Women" Women />
            </div>
          </div>

          <div class="pb-6">
            <div class="font-medium mb-2 flex">
              <p>Age:</p>
              <span id="leftThumbValue" style="margin-left:auto; font-weight:bold;">30</span>
              <span>-</span>
              <span id="rightThumbValue" style="font-weight:bold;">60</span>
            </div>

            <div slider id="slider-distance">
              <div>
                <div inverse-left style="width:70%;"></div>
                <div inverse-right style="width:70%;"></div>
                <div range style="left:30%;right:40%;"></div>
                <span thumb style="left:30%;"></span>
                <span thumb style="left:60%;"></span>
                <div sign style="left:30%;">
                  <span id="value">30</span>
                </div>
                <div sign style="left:60%;">
                  <span id="value">60</span>
                </div>
              </div>
              <input type="range" name="ageMin" tabindex="0" value="30" max="100" min="0" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

              <input type="range" name="ageMax" tabindex="0" value="60" max="100" min="0" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />
            </div>
          </div>
        </div>

        <fieldset class="flex my-8">
          <div>
            <label for="obese"><b>Exclude Obese</b></label>
            <input type="checkbox" name="obese" id="obese" />
          </div>
          <div style="margin-left:auto;">
            <label style="" for="married"><b>Exclude Married</b></label>
            <input type="checkbox" name="married" id="married" />
          </div>
        </fieldset>

        <div class="pb-6">
          <div class="font-medium mb-2 flex">
            <p>Height:</p>
            <span id="leftThumbValueH" style="margin-left:auto; font-weight:bold;">5'0''</span>
            <span>-</span>
            <span id="rightThumbValueH" style="font-weight:bold;">6'0''</span>
          </div>
          <div slider id="slider-height">
            <div>
              <div inverse-left style="width:70%;"></div>
              <div inverse-right style="width:70%;"></div>
              <div range style="left:30%;right:40%;"></div>
              <span class="thumb drop-shadow-xl" id="leftThumb" style="left:30%;" data-feet="5" data-inches="0"></span>
              <span class="thumb drop-shadow-xl" id="rightThumb" style="left:60%;" data-feet="6" data-inches="0"></span>
              <div sign style="left:30%;">
                <span id="leftThumbFeet">5</span>'<span id="leftThumbInches">0</span>"
              </div>
              <div sign style="left:60%;">
                <span id="rightThumbFeet">6</span>'<span id="rightThumbInches">0</span>"
              </div>
            </div>
            <input name="heightMin" type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
      this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[1].style.width=value+'%';
      children[5].style.left=value+'%';
      children[7].style.left=value+'%';children[11].style.left=value+'%';
      document.getElementById('leftThumbValueH').textContent = `${Math.floor(this.value / 12)}'${this.value % 12}''`;
      document.getElementById('leftThumb').setAttribute('data-feet', Math.floor(this.value / 12));
      document.getElementById('leftThumb').setAttribute('data-inches', this.value % 12);
      document.getElementById('leftThumbFeet').textContent = `${Math.floor(this.value / 12)}'${this.value % 12}''`;

    " />

            <input name="heightMax" type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
      this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[3].style.width=(100-value)+'%';
      children[5].style.right=(100-value)+'%';
      children[9].style.left=value+'%';children[13].style.left=value+'%';
      document.getElementById('rightThumbValueH').textContent = `${Math.floor(this.value / 12)}'${this.value % 12}''`;
      document.getElementById('rightThumb').setAttribute('data-feet', Math.floor(this.value / 12));
      document.getElementById('rightThumb').setAttribute('data-inches', this.value % 12);
      document.getElementById('rightThumbFeet').textContent = `${Math.floor(this.value / 12)}'${this.value % 12}''`;
    " />
          </div>
        </div>


        <div class="pb-6">
          <div class="font-medium mb-2 flex py-6">
            <p>Income:</p>
            <span style="margin-left:auto;">$</span><span id="leftThumbValueI"
              style="font-weight:bold;">30</span><span>K</span>
            <span> - </span>
            <span>$</span><span id="rightThumbValueI" style="font-weight:bold;">60</span><span>K</span>
          </div>

          <div slider id="slider-distance">
            <div>
              <div inverse-left style="width:70%;"></div>
              <div inverse-right style="width:70%;"></div>
              <div range style="left:30%;right:40%;"></div>
              <span thumb style="left:30%;"></span>
              <span thumb style="left:60%;"></span>
              <div sign style="left:30%;">
                <span id="value">30</span>
              </div>
              <div sign style="left:60%;">
                <span id="value">60</span>
              </div>
            </div>
            <input name="minIncome" type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value * 5;
  document.getElementById('leftThumbValueI').textContent = `${this.value * 5}`;
  " />

            <input name="maxIncome" type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value * 5;
  document.getElementById('rightThumbValueI').textContent = `${this.value * 5}`;

  " />
          </div>
        </div>
        <div>
          <p class="font-medium mb-2">Ethnicity</p>
          <div class="relative">
            <select name="ethnicity" id="ethnicity">
              <option value="white">White</option>
              <option value="black">Black</option>
              <option value="hispanic">Hispanic</option>
              <option value="asian">Asian</option>
              <option value="american-indian-alaska-native">American Indian/Alaska Native</option>
              <option value="other-multiple">Other/Multiple</option>
            </select>
          </div>
          <div class="mt-6">
            <button type="submit"
              class="inline-flex justify-between hover:bg-blue-400 text-xl py-8 bg-black text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 w-full py-3">
              Let's Find Out <i class="fa-regular fa-circle-right"></i>
            </button>
          </div>
          <p class="text-center text-sm text-gray-500 mt-4">Calculated using U.S. Census Bureau Data</p>
        </div>

      </div>

      <script>

        document.addEventListener("DOMContentLoaded", function () {
          const leftThumbValue = document.getElementById('leftThumbValue');
          const rightThumbValue = document.getElementById('rightThumbValue');

          // Get the sliders
          const leftSlider = document.querySelector('input[type="range"][tabindex="0"][value="30"]');
          const rightSlider = document.querySelector('input[type="range"][tabindex="0"][value="60"]');

          // Update the values initially
          leftThumbValue.textContent = leftSlider.value;
          rightThumbValue.textContent = rightSlider.value;

          // Add event listeners to update the values when sliders are moved
          leftSlider.addEventListener('input', function () {
            leftThumbValue.textContent = this.value;
          });

          rightSlider.addEventListener('input', function () {
            rightThumbValue.textContent = this.value;
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
          // Check if the button is already selected
          const isSelected = this.classList.contains('selected');
          console.log("Button Clicked ! Gender !");
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

  </body>

  </html>



  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("delusioncalculator_shortcode", "DelusionCalculator");

?>
