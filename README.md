Statamic-Future
=============
An Add-on for Statamic v2.x

## What is Does
Loops through an array of future dates, days, months, or years

## Installation
Copy the `Future` folder to your `site/addons` directory

## Parameters

* `type`: "date", "year", "month", or "day". Defaults to `date`
* `step`: The stepping interval. Defaults to `1`
* `limit`: The number of values to return. Defaults to `5`
* `inclusive`: Whether or not to include the current date, day, month, or year. Defaults to `false`

## Variables

* `value`: The current value of the loop.


## Examples

### Output 10 years, inclusively, as form select options
~~~
<select name="year">
{{ future type="year" step="1" limit="10" inclusive="true" }}
  <option value="{{ value }}">{{ value }}</option>
{{ /future }}
</select>
~~~

### Output 5 dates, skipping every other day
~~~
{{ future type="date" step="2" limit="5" }}
  {{ value datestring }}
{{ /future }}
~~~
