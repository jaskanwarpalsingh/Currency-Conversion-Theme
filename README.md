# Task One :
------------------
**Task Description :** A template page that will display current currency conversion rates. Please use a public API such as ExchangeRate-API. The API call should be done on the backend. The page will display only 1 conversion rate, and there is no need to implement a conversion calculator. For example: 1 USD -> 0.83 EUR.

**Solution:** I've developed an action in the WordPress and hit an Ajax request from the front end to pass the selected currency (selected in the wp admin), and fetch the conversion details to display on the front page.

# Task Two :
------------------
**Task Description:** Include an admin page that will allow choosing the pair of currencies. List at least 5 currencies and enable pairing them all with each other (no need to implement blocking pairing a currency with itself). 

**Solution:** I've create a new options page in the WP admin to select the currencies.

**API Details :**

* API Key: 5ca7bd73a314347f2829e7fa
* Exchange API base URL for conversion: https://v6.exchangerate-api.com/v6/
* Country API base URL: https://restcountries.com/v3.1/currency/

# Task Three :
------------------
**Task Description:** On the frontend, use JavaScript (vanilla or JQuery) to detect the currency which the base currency is being converted to (the resulting currency). Then make an AJAX call to the REST countries api to retrieve the details of a country which you know uses the currency being converted. Display the list of languages that are used in that country as returned from the api. If the currency is used in more than one country, just choose one country. Please accommodate countries that use more than one language. In the list of currencies that are available for conversion, please include at least one currency that is used in a country that speaks more than one language. Refer to the example at the end of this document. 

**Solution:** I've used the jQuery to detect the currency, and hit an Ajax call to fetch the conversion details. Also, I've used an additional API to get the Country languages details, and displayed the required information on the front end.

# Task Four :
------------------
**Task Description:** Design the template page responsive with CSS. It should look decent on both mobile and desktop devices. No need for it to be visually beautiful, we would just like to see a small exhibition of your CSS skills. 

**Solution:** The output is responsive.

# Other Key Items :
------------------
* I've used the Github platform
* I've uploaded the standalone theme