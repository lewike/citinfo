var LWDate = {
    getDateTime: () => {
        var dateTime = {
          date: [],
          hour: [
            { label: '凌晨', value: '00' },
            { label: '1点', value: '01' },
            { label: '2点', value: '02' },
            { label: '3点', value: '03' },
            { label: '4点', value: '04' },
            { label: '5点', value: '05' },
            { label: '6点', value: '06' },
            { label: '7点', value: '07' },
            { label: '8点', value: '08' },
            { label: '9点', value: '09' },
            { label: '10点', value: '10' },
            { label: '11点', value: '11' },
            { label: '12点', value: '12' },
            { label: '13点', value: '13' },
            { label: '14点', value: '14' },
            { label: '15点', value: '15' },
            { label: '16点', value: '16' },
            { label: '17点', value: '17' },
            { label: '18点', value: '18' },
            { label: '19点', value: '19' },
            { label: '20点', value: '20' },
            { label: '21点', value: '21' },
            { label: '22点', value: '22' },
            { label: '23点', value: '23' },
          ],
          minute: [
            { label: '00分', value: '00' },
            { label: '10分', value: '10' },
            { label: '20分', value: '20' },
            { label: '30分', value: '30' },
            { label: '40分', value: '40' },
            { label: '50分', value: '50' }
          ]
        };
        var currentTime = Date.now()
        var date = new Date()
        var label = ''
        var year = ''
        var month = ''
        var day = ''
        for (var i = 0; i < 10; i++) {
          date.setTime(currentTime + 86400000 * i)
          year = date.getFullYear().toString()
          month = (date.getMonth() + 1).toString()
          day = date.getDate().toString()
          if (i == 0) {
            label = '今天'
          } else if (i == 1) {
            label = '明天'
          } else if (i == 2) {
            label = '后天'
          } else {
            label = month + '月' + day +'日'
          }
          month = month.length == 1? '0'+month:month
          day = day.length == 1? '0'+day:day
          dateTime.date.push({ label: label, value: year + '-' + month + '-' + day })
        }
      
        return dateTime
    },
    checkStartTime: (time) => {
        var newTime = new Date(time.replace(/-/g, '/'))
        var now = new Date()
        return newTime.getTime() > now.getTime()
    },
    formatDateTime: function (time) {
        var start = new Date(time)
        var today = new Date()
        var date = {};
        var todayTime = today.setHours(0, 0, 0, 0)
        if (time > todayTime + 86400000*3) {
            var month = this.intToSting(start.getMonth()+1)
            var day =  this.intToSting(start.getDate())
            date.day = start.getFullYear()+'-'+month+'-'+day
            date.type = 'none'
        } else if (time > todayTime + 86400000*2) {
            date.day = '后天'
            date.type = 'hou'
        } else if (time > todayTime + 86400000) {
            date.day = '明天'
            date.type = 'ming'
        } else if (time > todayTime) {
            date.day = '今天'
            date.type = 'jin'
        } else {
            date.day="过去"
        }
        date.hours = this.intToSting(start.getHours())
        date.minutes = this.intToSting(start.getMinutes())
        return date
    },
    intToSting: (value) => {
        value = value.toString()
        return value.length == 1? '0'+value:value
    }
}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = LWDate;
}

