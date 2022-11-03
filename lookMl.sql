view: accounts {
  sql_table_name: `accounts` ;;
  drill_fields: [account_id]
  
  
  #list all dimensions here
  dimension: country {
    type: string
    map_layer_name: countries
    sql: ${TABLE}.`Accounts Country` ;;
  }
  
  dimension: account_id {
    type: string
    sql: ${TABLE}.`Accounts Angaza ID` ;;
  }
  
  explore: accounts {
    join: derived_portfolio {
      type: left_outer
      relationship: one_to_many
      sql_on: ${accounts.account_id} = ${derived_portfolio.account_id} ;;
    }
  }
  measure: get_FRR {
    type: number
    value_format_name: percent_2
    sql: 1.0*{(MAX(derived_portfolio.`Portfolio Derived Previous Cumulative Paid`)
      /(aaccounts.`Accounts Unlock Price` - aaccounts.`Accounts Upfront Price` )) * 100} ;;
  }
}