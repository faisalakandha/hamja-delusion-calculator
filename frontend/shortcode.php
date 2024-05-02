<?php

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
      href="http://wp.docker.localhost:8000/wp-content/plugins/hamja-delusion-calculator/frontend/range.css" />
  </head>

  <body>


    <div class="bg-white p-8 rounded-lg shadow max-w-md mx-auto">
      <h2 class="text-2xl font-semibold mb-6">States meet your standards?</h2>
      <div class="space-y-6">
        <div>
          <p class="font-medium mb-2">Gender</p>
          <div class="flex gap-2">
            <button
              class="inline-flex hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 flex-1">
              Men
            </button>
            <button
              class="inline-flex hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex-1">
              Women
            </button>
          </div>
        </div>
        <div>
          <p class="font-medium mb-2">Wants kids</p>
          <div class="flex gap-2">
            <button
              class="inline-flex hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex-1">
              Either
            </button>
            <button
              class="inline-flex hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 flex-1">
              Yes
            </button>
            <button
              class="inline-flex hover:bg-black hover:text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 flex-1">
              No
            </button>
          </div>
        </div>
        <div class="pb-6">
          <p class="font-medium mb-2">Age</p>
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
            <input type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

            <input type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
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
      <div class="pb-6">
        <p class="font-medium mb-2">Height</p>
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
          <input type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

          <input type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />
        </div>
      </div>
      <div class="py-6">
        <p class="font-medium mb-2">Minimum Income</p>
        <input class="w-full h-10" type="range" min="1" max="100" value="50">
      </div>
      <div>
        <p class="font-medium mb-2">Ethnicity</p>
        <button type="button" role="combobox" aria-controls="radix-:R1clafnnja:" aria-expanded="false"
          aria-autocomplete="none" dir="ltr" data-state="closed" data-placeholder=""
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
          id="ethnicity">
          <span style="pointer-events:none">Any</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="h-4 w-4 opacity-50" aria-hidden="true">
            <path d="m6 9 6 6 6-6"></path>
          </svg>
        </button>
        <select aria-hidden="true" tabindex="-1"
          style="position:absolute;border:0;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;word-wrap:normal">
          <option value=""></option>
        </select>
      </div>
    </div>
    <div class="mt-6">
      <button
        class="inline-flex justify-between hover:bg-blue-400 text-xl py-8 bg-black text-white items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 w-full py-3">
        Let's Find Out <i class="fa-regular fa-circle-right"></i>
      </button>
    </div>
    <p class="text-center text-sm text-gray-500 mt-4">Calculated using U.S. Census Bureau Data</p>
    </div>

  </body>

  </html>



  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("delusioncalculator_shortcode", "DelusionCalculator");

?>
