/* eslint-disable object-shorthand */

/* global Chart, CustomTooltips, getStyle, hexToRgba */

/**
 * --------------------------------------------------------------------------
 * CoreUI Plugins - Custom Tooltips for Chart.js (v1.2.0): custom-tooltips.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */

function CustomTooltips(tooltipModel) {
  // Add unique id if not exist
  const _setCanvasId = () => {
    const _idMaker = () => {
      const _hex = 16
      const _multiplier = 0x10000
      return ((1 + Math.random()) * _multiplier | 0).toString(_hex)
    }
    const _canvasId = `_canvas-${_idMaker() + _idMaker()}`
    this._chart.canvas.id = _canvasId
    return _canvasId
  }

  const ClassName = {
    ABOVE                   : 'above',
    BELOW                   : 'below',
    CHARTJS_TOOLTIP         : 'chartjs-tooltip',
    NO_TRANSFORM            : 'no-transform',
    TOOLTIP_BODY            : 'tooltip-body',
    TOOLTIP_BODY_ITEM       : 'tooltip-body-item',
    TOOLTIP_BODY_ITEM_COLOR : 'tooltip-body-item-color',
    TOOLTIP_BODY_ITEM_LABEL : 'tooltip-body-item-label',
    TOOLTIP_BODY_ITEM_VALUE : 'tooltip-body-item-value',
    TOOLTIP_HEADER          : 'tooltip-header',
    TOOLTIP_HEADER_ITEM     : 'tooltip-header-item'
  }

  const Selector = {
    DIV     : 'div',
    SPAN    : 'span',
    TOOLTIP : `${this._chart.canvas.id || _setCanvasId()}-tooltip`
  }

  let tooltip = document.getElementById(Selector.TOOLTIP)

  if (!tooltip) {
    tooltip = document.createElement('div')
    tooltip.id = Selector.TOOLTIP
    tooltip.className = ClassName.CHARTJS_TOOLTIP
    this._chart.canvas.parentNode.appendChild(tooltip)
  }

  // Hide if no tooltip
  if (tooltipModel.opacity === 0) {
    tooltip.style.opacity = 0
    return
  }

  // Set caret Position
  tooltip.classList.remove(ClassName.ABOVE, ClassName.BELOW, ClassName.NO_TRANSFORM)
  if (tooltipModel.yAlign) {
    tooltip.classList.add(tooltipModel.yAlign)
  } else {
    tooltip.classList.add(ClassName.NO_TRANSFORM)
  }

  // Set Text
  if (tooltipModel.body) {
    const titleLines = tooltipModel.title || []

    const tooltipHeader = document.createElement(Selector.DIV)
    tooltipHeader.className = ClassName.TOOLTIP_HEADER

    titleLines.forEach((title) => {
      const tooltipHeaderTitle = document.createElement(Selector.DIV)
      tooltipHeaderTitle.className = ClassName.TOOLTIP_HEADER_ITEM
      tooltipHeaderTitle.innerHTML = title
      tooltipHeader.appendChild(tooltipHeaderTitle)
    })

    const tooltipBody = document.createElement(Selector.DIV)
    tooltipBody.className = ClassName.TOOLTIP_BODY

    const tooltipBodyItems = tooltipModel.body.map((item) => item.lines)
    tooltipBodyItems.forEach((item, i) => {
      const tooltipBodyItem = document.createElement(Selector.DIV)
      tooltipBodyItem.className = ClassName.TOOLTIP_BODY_ITEM

      const colors = tooltipModel.labelColors[i]

      const tooltipBodyItemColor = document.createElement(Selector.SPAN)
      tooltipBodyItemColor.className = ClassName.TOOLTIP_BODY_ITEM_COLOR
      tooltipBodyItemColor.style.backgroundColor = colors.backgroundColor

      tooltipBodyItem.appendChild(tooltipBodyItemColor)

      if (item[0].split(':').length > 1) {
        const tooltipBodyItemLabel = document.createElement(Selector.SPAN)
        tooltipBodyItemLabel.className = ClassName.TOOLTIP_BODY_ITEM_LABEL
        tooltipBodyItemLabel.innerHTML = item[0].split(': ')[0]

        tooltipBodyItem.appendChild(tooltipBodyItemLabel)

        const tooltipBodyItemValue = document.createElement(Selector.SPAN)
        tooltipBodyItemValue.className = ClassName.TOOLTIP_BODY_ITEM_VALUE
        tooltipBodyItemValue.innerHTML = item[0].split(': ').pop()

        tooltipBodyItem.appendChild(tooltipBodyItemValue)
      } else {
        const tooltipBodyItemValue = document.createElement(Selector.SPAN)
        tooltipBodyItemValue.className = ClassName.TOOLTIP_BODY_ITEM_VALUE
        tooltipBodyItemValue.innerHTML = item[0]

        tooltipBodyItem.appendChild(tooltipBodyItemValue)
      }

      tooltipBody.appendChild(tooltipBodyItem)
    })

    tooltip.innerHTML = ''

    tooltip.appendChild(tooltipHeader)
    tooltip.appendChild(tooltipBody)
  }

  const positionY = this._chart.canvas.offsetTop
  const positionX = this._chart.canvas.offsetLeft

  // Display, position, and set styles for font
  tooltip.style.opacity = 1
  tooltip.style.left = `${positionX + tooltipModel.caretX}px`
  tooltip.style.top = `${positionY + tooltipModel.caretY}px`
}

export default CustomTooltips

/* global Chart, CustomTooltips, getStyle */
import $ from 'jquery'

/**
 * --------------------------------------------------------------------------
 * CoreUI Free Boostrap Admin Template (v2.1.10): main.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */

/* eslint-disable no-magic-numbers */
// Disable the on-canvas tooltip
Chart.defaults.global.pointHitDetectionRadius = 1
Chart.defaults.global.tooltips.enabled = false
Chart.defaults.global.tooltips.mode = 'index'
Chart.defaults.global.tooltips.position = 'nearest'
Chart.defaults.global.tooltips.custom = CustomTooltips

// eslint-disable-next-line no-unused-vars
const cardChart1 = new Chart($('#card-chart1'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: getStyle('--primary'),
        borderColor: 'rgba(255,255,255,.55)',
        data: [65, 59, 84, 84, 51, 55, 40]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent'
        }
      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: 35,
          max: 89
        }
      }]
    },
    elements: {
      line: {
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const cardChart2 = new Chart($('#card-chart2'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: getStyle('--info'),
        borderColor: 'rgba(255,255,255,.55)',
        data: [1, 18, 9, 17, 34, 22, 11]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          color: 'transparent',
          zeroLineColor: 'transparent'
        },
        ticks: {
          fontSize: 2,
          fontColor: 'transparent'
        }
      }],
      yAxes: [{
        display: false,
        ticks: {
          display: false,
          min: -4,
          max: 39
        }
      }]
    },
    elements: {
      line: {
        tension: 0.00001,
        borderWidth: 1
      },
      point: {
        radius: 4,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const cardChart3 = new Chart($('#card-chart3'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: [78, 81, 80, 45, 34, 12, 40]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    },
    elements: {
      line: {
        borderWidth: 2
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const cardChart4 = new Chart($('#card-chart4'), {
  type: 'bar',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67, 82]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 0.6
      }],
      yAxes: [{
        display: false
      }]
    }
  }
})

// Random Numbers
const random = (min, max) => Math.floor(Math.random() * (max - min + 1) + min)

// eslint-disable-next-line no-unused-vars
const sparklineChart1 = new Chart($('#sparkline-chart-1'), {
  type: 'bar',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M'],
    datasets: [
      {
        backgroundColor: getStyle('--primary'),
        borderColor: 'transparent',
        borderWidth: 1,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    }
  }
})

// eslint-disable-next-line no-unused-vars
const sparklineChart2 = new Chart($('#sparkline-chart-2'), {
  type: 'bar',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M'],
    datasets: [
      {
        backgroundColor: getStyle('--warning'),
        borderColor: 'transparent',
        borderWidth: 1,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    }
  }
})

// eslint-disable-next-line no-unused-vars
const sparklineChart3 = new Chart($('#sparkline-chart-3'), {
  type: 'bar',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S', 'M', 'T', 'W', 'T', 'F', 'S', 'S', 'M'],
    datasets: [
      {
        backgroundColor: getStyle('--success'),
        borderColor: 'transparent',
        borderWidth: 1,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    }
  }
})

// eslint-disable-next-line no-unused-vars
const sparklineChart4 = new Chart($('#sparkline-chart-4'), {
  type: 'line',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: getStyle('--info'),
        borderWidth: 2,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    },
    elements: {
      point: {
        radius: 0
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const sparklineChart5 = new Chart($('#sparkline-chart-5'), {
  type: 'line',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: getStyle('--success'),
        borderWidth: 2,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    },
    elements: {
      point: {
        radius: 0
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const sparklineChart6 = new Chart($('#sparkline-chart-6'), {
  type: 'line',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [
      {
        backgroundColor: 'transparent',
        borderColor: getStyle('--danger'),
        borderWidth: 2,
        data: [random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100), random(40, 100)]
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        display: false
      }],
      yAxes: [{
        display: false
      }]
    },
    elements: {
      point: {
        radius: 0
      }
    }
  }
})

const brandBoxChartLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
const brandBoxChartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      display:false
    }],
    yAxes: [{
      display:false
    }]
  },
  elements: {
    point: {
      radius: 0,
      hitRadius: 10,
      hoverRadius: 4,
      hoverBorderWidth: 3
    }
  }
}

// eslint-disable-next-line no-unused-vars
const brandBoxChart1 = new Chart($('#social-box-chart-1'), {
  type: 'line',
  data: {
    labels: brandBoxChartLabels,
    datasets: [{
      backgroundColor: 'rgba(255,255,255,.1)',
      borderColor: 'rgba(255,255,255,.55)',
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [65, 59, 84, 84, 51, 55, 40]
    }]
  },
  options: brandBoxChartOptions
})

// eslint-disable-next-line no-unused-vars
const brandBoxChart2 = new Chart($('#social-box-chart-2'), {
  type: 'line',
  data: {
    labels: brandBoxChartLabels,
    datasets: [{
      backgroundColor: 'rgba(255,255,255,.1)',
      borderColor: 'rgba(255,255,255,.55)',
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [1, 13, 9, 17, 34, 41, 38]
    }]
  },
  options: brandBoxChartOptions
})

// eslint-disable-next-line no-unused-vars
const brandBoxChart3 = new Chart($('#social-box-chart-3'), {
  type: 'line',
  data: {
    labels: brandBoxChartLabels,
    datasets: [{
      backgroundColor: 'rgba(255,255,255,.1)',
      borderColor: 'rgba(255,255,255,.55)',
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [78, 81, 80, 45, 34, 12, 40]
    }]
  },
  options: brandBoxChartOptions
})

// eslint-disable-next-line no-unused-vars
const brandBoxChart4 = new Chart($('#social-box-chart-4'), {
  type: 'line',
  data: {
    labels: brandBoxChartLabels,
    datasets: [{
      backgroundColor: 'rgba(255,255,255,.1)',
      borderColor: 'rgba(255,255,255,.55)',
      pointHoverBackgroundColor: '#fff',
      borderWidth: 2,
      data: [35, 23, 56, 22, 97, 23, 64]
    }]
  },
  options: brandBoxChartOptions
})
