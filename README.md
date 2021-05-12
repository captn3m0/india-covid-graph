## data

-[x] Caravan
-[x] Scroll
-[x] Wire
-[x] Hindu
-[ ] Print
-[ ] TheNewsMinute
-[ ] NDTV

# Print

  for i in $(seq 1 45); do curl -s "https://theprint.in/page/$i/?s=corona" -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:88.0) Gecko/20100101 Firefox/88.0' | pup '.td-main-content' >> print.html && echo $i && sleep 2; done

# Scroll
  for i in $(seq 1 33); do curl -s "https://scroll.in/search?q=corona&page=$i&format=json" -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:88.0) Gecko/20100101 Firefox/88' > "scroll-$i.json" ; done;

# Hindu

  cat hindu.html |pup '.story-card-news json{}'> hindu.json
  php hindu.php