## data

-[x] Caravan
-[x] Scroll
-[x] Wire
-[x] Print
-[ ] Hindu
-[ ] TheNewsMinute
-[ ] NDTV

# Hindu

    cat hindu.html |pup '.story-card-news json{}'> hindu.json
    php hindu.php