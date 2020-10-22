/**
 * @file
 * JavaScript which manages the "Outdated Browser" plug-in.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js
// @prepros-prepend polyfills/addEventListener.js

(function (window, document) {

  'use strict';

  /**
   * @object languages
   */
  var languages = [
    {
      'lang'  : 'en',
      'title' : 'Your Web Browser is out of date!',
      'text'  : 'For more Security, Speed and a better Experience on this site, ',
      'link'  : 'Update your Browser.',
      'close' : 'Close'
    },
    {
      'lang'  : 'fr',
      'title' : 'Votre Navigateur Web n\'est pas à jour !',
      'text'  : 'Pour plus de Sécurité, de Rapidité et une meilleure Expérience sur ce site, ',
      'link'  : 'Mettez à jour votre Navigateur.',
      'close' : 'Fermer'
    },
    {
      'lang'  : 'nl',
      'title' : 'Uw Webbrowser is verouderd.',
      'text'  : 'Voor meer Veiligheid, Snelheid en om deze site Optimaal te kunnen gebruiken, ',
      'link'  : 'Update uw Browser.',
      'close' : 'Sluiten'
    },
    {
      'lang'  : 'de',
      'title' : 'Ihr Webbrowser ist veraltet.',
      'text'  : 'Für mehr Sicherheit, Geschwindigkeit und den besten Komfort auf dieser Seite, ',
      'link'  : 'Aktualisieren Sie Ihren Browser.',
      'close' : 'Schließen'
    },
    {
      'lang'  : 'es',
      'title' : 'U Navegador Web está desactualizado.',
      'text'  : 'Para obtener más Seguridad, Velocidad y para disfrutar de la mejor Experiencia en este sitio, ',
      'link'  : 'Actualice su Navegador.',
      'close' : 'Cerrar'
    },
    {
      'lang'  : 'it',
      'title' : 'Il Tuo Browser non è aggiornato.',
      'text'  : 'Per una maggiore Sicurezza, Velocità e la migliore Esperienza su questo sito, ',
      'link'  : 'Aggiorna il Browser.',
      'close' : 'Chiudi'
    }
  ];

  var wrapper, heading, paragraph, link, button;
  var outdatedBrowserClass = 'outdated-browser';
  var userLang = document.querySelector('html').getAttribute('lang');
  var textLang = languages[0]; // Default EN
  var ieTarget = parseInt(document.head.querySelector('meta[name="outdatedbrowser-ieTarget"]').getAttribute('content'));
  var cssExplicit = document.head.querySelector('meta[name="outdatedbrowser-cssExplicit"]');
  var cssExclude = document.head.querySelector('meta[name="outdatedbrowser-cssExclude"]');

  /*
   * @init outdatedBrowser
   */
  if (isTarget(ieTarget) && isCssMatching(cssExplicit, cssExclude)) {
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
      paragraph.appendChild(document.createTextNode(textLang.text));
      wrapper.appendChild(paragraph);

      // Create the "Update your browser" (link) element.
      link = document.createElement('a');
      link.setAttribute('href', 'http://outdatedbrowser.com/' + textLang.lang);
      link.appendChild(document.createTextNode(textLang.link));
      paragraph.appendChild(link);

      // Create a <button> element to close (make disappear) the message.
      button = document.createElement('button');
      button.classList.add(outdatedBrowserClass + '__close');
      button.setAttribute('type', 'button');
      button.setAttribute('title', textLang.close);
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
   * @method isTarget
   */
  function isTarget(ieTarget) {
    var ua = window.navigator.userAgent;

    // Microsoft Internet Explorer 10 or older.
    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
      return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10) <= ieTarget;
    }

    // Microsoft Internet Explorer 11.
    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
      var rv = ua.indexOf('rv:');
      return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10) <= ieTarget;
    }

    return false;
  }

  /*
   * @method isCssMatching
   */
  function isCssMatching(cssExplicit, cssExclude) {
    var flag = true;
    var websitePage;

    // Only look for Website pages inside CSS selectors.
    if (cssExplicit != null) {
      var cssExplicits = cssExplicit.getAttribute('content').replace(' ', '').split(',');
      for (var i=0; i < cssExplicits.length; i++) {
        websitePage = document.querySelector('body' + cssExplicits[i]);

        // Check whether we are looking for this Website page.
        if (websitePage instanceof Element) {
          flag = true;
          break;
        }
        else {
          flag = false;
        }
      }
    }

    // Exclude Website pages inside CSS selectors.
    if (cssExclude != null) {
      var cssExcludes = cssExclude.getAttribute('content').replace(' ', '').split(',');
      for (var i=0; i < cssExcludes.length; i++) {
        websitePage = document.querySelector('body' + cssExcludes[i]);

        // Check whether we are excluding this Website page.
        if (websitePage instanceof Element) {
          flag = false;
          break;
        }
        else {
          flag = true;
        }
      }
    }

    return flag;
  }

  /*
   * @method removeOutdatedBrowserMessage
   */
  function removeOutdatedBrowserMessage(wrapper) {
    document.body.removeChild(wrapper);
    document.body.classList.remove(outdatedBrowserClass + '--message-visible');
  }

}) (this, this.document);
