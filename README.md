# India Covid Graph

An attempt at making an interactive version of the famous
visualization by pen paper pencils.

The more useful aspect is the covid news dataset.

## data

- [x] Caravan
- [x] Scroll
- [x] Wire
- [x] Print
- [ ] Hindu
- [ ] TheNewsMinute
- [ ] NDTV

# Hindu

    cat hindu.html |pup '.story-card-news json{}'> hindu.json
    php hindu.php