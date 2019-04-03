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

/* eslint-disable object-curly-newline */
/* global Chart */
import $ from 'jquery'

/**
 * --------------------------------------------------------------------------
 * CoreUI Free Boostrap Admin Template (v2.1.10): main.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */

/* eslint-disable no-magic-numbers */
// random Numbers
const random = () => Math.round(Math.random() * 100)

// eslint-disable-next-line no-unused-vars
const lineChart = new Chart($('#canvas-1'), {
  type: 'line',
  data: {
    labels : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets : [
      {
        label: 'My First dataset',
        backgroundColor : 'rgba(220, 220, 220, 0.2)',
        borderColor : 'rgba(220, 220, 220, 1)',
        pointBackgroundColor : 'rgba(220, 220, 220, 1)',
        pointBorderColor : '#fff',
        data : [random(), random(), random(), random(), random(), random(), random()]
      },
      {
        label: 'My Second dataset',
        backgroundColor : 'rgba(151, 187, 205, 0.2)',
        borderColor : 'rgba(151, 187, 205, 1)',
        pointBackgroundColor : 'rgba(151, 187, 205, 1)',
        pointBorderColor : '#fff',
        data : [random(), random(), random(), random(), random(), random(), random()]
      }
    ]
  },
  options: {
    responsive: true
  }
})

// eslint-disable-next-line no-unused-vars
const barChart = new Chart($('#canvas-2'), {
  type: 'bar',
  data: {
    labels : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets : [
      {
        backgroundColor : 'rgba(220, 220, 220, 0.5)',
        borderColor : 'rgba(220, 220, 220, 0.8)',
        highlightFill: 'rgba(220, 220, 220, 0.75)',
        highlightStroke: 'rgba(220, 220, 220, 1)',
        data : [random(), random(), random(), random(), random(), random(), random()]
      },
      {
        backgroundColor : 'rgba(151, 187, 205, 0.5)',
        borderColor : 'rgba(151, 187, 205, 0.8)',
        highlightFill : 'rgba(151, 187, 205, 0.75)',
        highlightStroke : 'rgba(151, 187, 205, 1)',
        data : [random(), random(), random(), random(), random(), random(), random()]
      }
    ]
  },
  options: {
    responsive: true
  }
})

// eslint-disable-next-line no-unused-vars
const doughnutChart = new Chart($('#canvas-3'), {
  type: 'doughnut',
  data: {
    labels: ['Red', 'Green', 'Yellow'],
    datasets: [{
      data: [300, 50, 100],
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
      hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
    }]
  },
  options: {
    responsive: true
  }
})

// eslint-disable-next-line no-unused-vars
const radarChart = new Chart($('#canvas-4'), {
  type: 'radar',
  data: {
    labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
    datasets: [
      {
        label: 'My First dataset',
        backgroundColor: 'rgba(220, 220, 220, 0.2)',
        borderColor: 'rgba(220, 220, 220, 1)',
        pointBackgroundColor: 'rgba(220, 220, 220, 1)',
        pointBorderColor: '#fff',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220, 220, 220, 1)',
        data: [65, 59, 90, 81, 56, 55, 40]
      },
      {
        label: 'My Second dataset',
        backgroundColor: 'rgba(151, 187, 205, 0.2)',
        borderColor: 'rgba(151, 187, 205, 1)',
        pointBackgroundColor: 'rgba(151, 187, 205, 1)',
        pointBorderColor: '#fff',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(151, 187, 205, 1)',
        data: [28, 48, 40, 19, 96, 27, 100]
      }
    ]
  },
  options: {
    responsive: true
  }
})

// eslint-disable-next-line no-unused-vars
const pieChart = new Chart($('#canvas-5'), {
  type: 'pie',
  data: {
    labels: ['Red', 'Green', 'Yellow'],
    datasets: [{
      data: [300, 50, 100],
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
      hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
    }]
  },
  options: {
    responsive: true
  }
})

// eslint-disable-next-line no-unused-vars
const polarAreaChart = new Chart($('#canvas-6'), {
  type: 'polarArea',
  data: {
    labels: ['Red', 'Green', 'Yellow', 'Grey', 'Blue'],
    datasets: [{
      data: [11, 16, 7, 3, 14],
      backgroundColor: ['#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB']
    }]
  },
  options: {
    responsive: true
  }
})
