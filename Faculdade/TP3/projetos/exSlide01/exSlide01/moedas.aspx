<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="moedas.aspx.cs" Inherits="exSlide01.moedas" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
            <h1>Moedas</h1>
        </div>
        <div>
            <asp:HyperLink ID="HyperLink3" runat="server" NavigateUrl="~/inicio.aspx">Inicio</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink1" runat="server" NavigateUrl="~/abastecer.aspx">Abastecer</asp:HyperLink>
            <br />
            <asp:HyperLink ID="HyperLink2" runat="server" NavigateUrl="~/moedas.aspx">Moedas</asp:HyperLink>
        </div>
        <div>

            <asp:Label ID="Label1" runat="server" Text="Converter:"></asp:Label>
            <asp:TextBox ID="tbReal" runat="server"></asp:TextBox>
            <br />
            <asp:Label ID="Label3" runat="server" Text="Para:"></asp:Label>
            <asp:DropDownList ID="ddlMoeda" runat="server">
                <asp:ListItem Selected="True">dolar</asp:ListItem>
                <asp:ListItem>euro</asp:ListItem>
                <asp:ListItem>libra</asp:ListItem>
            </asp:DropDownList>

            <br />
            <asp:RadioButton ID="rbReal" runat="server" Text="Real > Estrangeiro" runat="server" GroupName="rbMoeda" Checked ="true" />
            <asp:RadioButton ID="rbEstrangeira" runat="server" Text="Estrangeiro > Real" runat="server" GroupName="rbMoeda" />
            <asp:RadioButtonList ID="rbMoeda" runat="server"></asp:RadioButtonList>
            <br />
            <asp:Button ID="Button1" runat="server" Text="Converter" OnClick="Button1_Click" />
            <br />
            <asp:Label ID="Label2" runat="server" Text="Valor Convertido: "></asp:Label>
            <asp:Label ID="lbNovoValor" runat="server" Text=""></asp:Label>



        </div>
    </form>
</body>
</html>
