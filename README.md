# India Covid Graph

An attempt at making an interactive version of the famous
visualization by penpencildraw.

![what they said when](https://pbs.twimg.com/media/EzubAnnUUAgPpPs?format=jpg&name=small)

Ref: https://x.com/penpencildraw/status/1385871750798331904/photo/1

The more useful aspect is probably the covid news dataset that came out of this.

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