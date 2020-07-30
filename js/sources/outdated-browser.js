/**
 * @file
 * JavaScript which manages the "Outdated Browser" plug-in.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js

(function (window, document, drupalSettings) {

  'use strict';

  /**
   * @object languages
   */
  var languages = [
    {
      'lang'  : 'en',
      'title' : 'Your web browser is out of date!',
      'link'  : 'Update your browser',
      'text'  : 'for more security, speed and a better experience on this site.',
      'close' : 'Close'
    },
    {
      'lang'  : 'fr',
      'title' : 'Votre navigateur Web n\'est pas à jour !',
      'link'  : 'Mettez à jour votre navigateur',
      'text'  : 'pour plus de sécurité, de rapidité et une meilleure expérience sur ce site.',
      'close' : 'Fermer'
    },
    {
      'lang'  : 'nl',
      'title' : 'Uw webbrowser is verouderd.',
      'link'  : 'Update uw browser',
      'text'  : 'voor meer veiligheid, snelheid en om deze site optimaal te kunnen gebruiken.',
      'close' : 'Sluiten'
    },
    {
      'lang'  : 'de',
      'title' : 'Ihr Webbrowser ist veraltet.',
      'link'  : 'Aktualisieren Sie Ihren Browser',
      'text'  : 'für mehr Sicherheit, Geschwindigkeit und den besten Komfort auf dieser Seite.',
      'close' : 'Schließen'
    },
    {
      'lang'  : 'es',
      'title' : 'u navegador web está desactualizado.',
      'link'  : 'Actualice su navegador',
      'text'  : 'para obtener más seguridad, velocidad y para disfrutar de la mejor experiencia en este sitio.',
      'close' : 'Cerrar'
    },
    {
      'lang'  : 'it',
      'title' : 'Il tuo browser non è aggiornato.',
      'link'  : 'Aggiorna il browser',
      'text'  : 'per una maggiore sicurezza, velocità e la migliore esperienza su questo sito.',
      'close' : 'Chiudi'
    }
  ];

  var wrapper, heading, paragraph, button;
  var outdatedBrowserClass = 'outdated-browser';
  var userLang = document.querySelector('html').getAttribute('lang');
  var textLang = languages[0]; // Default EN
  var ieVersion = (!!window.ActiveXObject && +(/msie\s(\d+)/i.exec(navigator.userAgent)[1])) || NaN;

  /*
   * @init outdatedBrowser
   */
  if (ieVersion <= 9) {
    for (var key in languages) {
      var regex = new RegExp(languages[key].lang);

      // Check if we've the user language.
      if (regex.test(userLang.toLowerCase())) {
        textLang = languages[key];
        break;
      }
    }

    setTimeout(function () {
      // Create a general <div> (wrapper) element.
      wrapper = document.createElement('div');
      wrapper.classList.add(outdatedBrowserClass);
      wrapper.setAttribute('role', 'alert');

      // Create an <h2> (heading) element for the title.
      heading = document.createElement('h2');
      heading.classList.add(outdatedBrowserClass + '__title');
      heading.appendChild(document.createTextNode(textLang.title));
      wrapper.appendChild(heading);

      // Create a <p> (paragraph) element which will contain
      // both the "Outdated Browser" link and the text.
      paragraph = document.createElement('p');
      paragraph.innerHTML = '<a href="http://outdatedbrowser.com/' + textLang.lang + '">' + textLang.link + '</a> ' + textLang.text;
      wrapper.appendChild(paragraph);

      // Create a <button> element to close (make disappear) the message.
      button = document.createElement('button');
      button.classList.add(outdatedBrowserClass + '__close');
      button.setAttribute('type', 'button');
      button.appendChild(document.createTextNode(textLang.close));
      button.addEventListener('click', function () { removeOutdatedBrowserMessage(wrapper) });
      wrapper.appendChild(button);

      // Append the finalized "Outdated Browser" message to the end of the <boby> element.
      document.body.appendChild(wrapper);
      // Added useful class on this <body> element.
      document.body.classList.add(outdatedBrowserClass + '--message-visible');
    }, 1000);
  }

  /*
   * @method removeOutdatedBrowserMessage
   */
  function removeOutdatedBrowserMessage(wrapper) {
    document.body.removeChild(wrapper);
    document.body.classList.remove(outdatedBrowserClass + '--message-visible');
  }

}) (this, this.document, drupalSettings);
