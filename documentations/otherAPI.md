# LLM Model Integrations

We would be focusing on 3 LLMs right now, if time allows, we could expand the
field of the project further into more LLM models that incorporate the openAi
api as their format of API calls.

The three LLM models that we would be working on right now would include Grok,
Gemini, and Perplexity. And here are the documentations below for the different APIs.


## Grok

### General View over the API

The official documentation of the the Grok API is listed on the following link:
https://docs.x.ai/docs/overview

For our project specifically, we want to integrate the Grok API into the OpenAI API
and make sure that they would work with the same parameters, so the specific page 
that we want to look at is the following: 

https://docs.x.ai/docs/guides/migration.

According to the Grok documentation, we could see that the change is pretty simple
when it comes to changing the API call, there are only two lines of required changes,
which is the base_url and the model name, which are both variables that we are capable
of changing in the library.

### Utilizing the API with OpenAI-PHP

After some testings with the code, I had some advancements with integrating the current
Grok AI API with the openai-php library. The GrokAI API would response to the same format
that we use in calling the openai-php. After some changes to the client class and the API
keys, I figured that all we have to do right here is the same as the documentation. There 
are three parts that we have to change, the BaseURL, the API keys, and the model name.
Once we changed those, the openai-php library would act the exact same as it returns 
response from Grok AI and not OpenAI.

```php
$client = OpenAI::factory()
    ->withApiKey($_ENV["GROK_API_KEY"])
    ->withOrganization('your-organization') // default: null
    ->withProject('Your Project') // default: null
    ->withBaseUri('https://api.x.ai/v1') // default: api.openai.com/v1
    ->make();

$result = $client->chat()->create([
    'model' => 'grok-2-latest',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!, who are you'],
    ],
]);

echo $result->choices[0]->message->content; 

```

After we figure this out thew chat function with the GROK AI API, what we need to do 
further is to make sure that we can utilize the same function other services that GROK AI
provides, but when we follow the same structure, I believe that we can make the progression
more efficient with the example that we already have.


The progress that we have right now is actually something that we can consider useful in the library.
When users call the Openai-php and create the client, we switched out the process of making them enter
their base urls, and now they can just enter llm provider name to make sure switch baseURLs for 
different providers. 

For example, the code below could demonstrate when the user creates a client directly with a different
provider.

```php
$client = OpenAI::factory()
    ->withApiKey($_ENV["GROK_API_KEY"])
    ->withOrganization('your-organization') // default: null
    ->withProject('Your Project') // default: null
    ->withProvider('grok') // Could be Grok, grok, GROK, but anything else would be set to openai
    ->make();
```
Now this sets the default baseURL to Grok's baseURL, and instead of taking away the function that allows
users to set upon their own url, this is just a quick fix that allows people to simply click in and change
the provider easily.


## Gemini

### General View over the API

The Official documentation of Gemini is the following:
https://ai.google.dev/gemini-api/docs

The Gemini documentation for OpenAI API compatibility are relatively similar to what 
we had seen with the Grok documentation, it is specified that there are 3 lines that 
we would have to change, and they are the API keys, base_url, and model (a model name 
that is recognizable by gemini).

Looking at these Gemini models, there are no big difference from what we seen from the 
Grok tuning with compatibility of the OpenAI API, which is a really good news to us 
especially when we are aiming for development to integrate the different LLMs

The following is the OpenAI compatibility web link of Gemini:
https://ai.google.dev/gemini-api/docs/openai

### Utilizing the API with OpenAI-PHP
For the Gemini AI API, I tried to integrate the same thing with GROK onto Gemini, but
the integration didnt work, there are still some errors that I would need to work on 
integrating Gemini and it would still require some work of progress.


## Perplexity:








